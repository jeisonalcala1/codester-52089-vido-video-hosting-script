async function loadVideoData() {
    try {
        const metadataResponse = await fetch('../metadata.json');
        const metadata = await metadataResponse.json();
        const totalVideos = metadata.length;
        document.getElementById('totalVideos').textContent = `${totalVideos} Video`;

        const videoCounts = [];
        const hoursIn24 = 24;
        const totalIntervals = Math.ceil(totalVideos / hoursIn24);
        for (let i = 0; i < totalIntervals; i++) {
            videoCounts.push(0);
        }

        for (let i = 0; i < totalVideos; i++) {
            videoCounts[i % totalIntervals] += 1;
        }

        const labels = Array.from({ length: totalIntervals }, () => '');
        const chartData = videoCounts;

        const ctx = document.getElementById('videoChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Videos Uploaded',
                    data: chartData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: '24-Hour Intervals'
                        },
                        ticks: {
                            display: false
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Uploads'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        const viewsResponse = await fetch('../views.json');
        const viewsData = await viewsResponse.json();

        let mostPopularVideo = '';
        let maxViews = 0;
        for (const [videoTitle, views] of Object.entries(viewsData)) {
            if (views > maxViews) {
                maxViews = views;
                mostPopularVideo = videoTitle;
            }
        }

        document.getElementById('mostPopularVideo').textContent = mostPopularVideo || 'No Videos Available';
        document.getElementById('viewsCount').textContent = maxViews > 0 ? `${maxViews} Views` : '0 Views';

        const videoID = mostPopularVideo;
        let currentURL = window.location.href;
        const urlParts = currentURL.split('/');
        const filteredParts = urlParts.filter(part => part !== 'admin');
        const baseURL = filteredParts.join('/');
        const videoLink = `${baseURL}v?go=${videoID}`;
        document.getElementById('mostPopularVideo').setAttribute('href', videoLink);

        const newVideosList = document.getElementById('newVideosList');
        const videoTitles = Object.keys(viewsData);
        const latestVideos = videoTitles.slice(-5);
        newVideosList.innerHTML = '';

        latestVideos.forEach(videoTitle => {
            const listItem = document.createElement('li');
            const videoLink = document.createElement('a');
            videoLink.textContent = videoTitle;
            videoLink.className = 'text-white hover:underline cursor-pointer';
            videoLink.href = `${baseURL}v?go=${videoTitle}`;
            videoLink.target = '_blank';
            listItem.appendChild(videoLink);
            newVideosList.appendChild(listItem);
        });

    } catch (error) {
        console.error('Error loading video data:', error);
    }
}

loadVideoData();
document.getElementById('menu-button').addEventListener('click', function() {
    document.getElementById('menu').classList.toggle('hidden');
});
