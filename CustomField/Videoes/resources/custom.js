// دریافت المان‌های DOM
const videoElement = document.getElementById('videoElement');
const recordButton = document.getElementById('recordButton');

// بررسی پشتیبانی مرورگر از ویژگی MediaDevices
if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // درخواست دسترسی به دوربین
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(stream) {
            // نمایش ویدئو در المان video
            videoElement.srcObject = stream;
        })
        .catch(function(error) {
            console.error('خطا در دسترسی به دوربین: ', error);
        });

    // رویداد کلیک بر روی دکمه ضبط
    recordButton.addEventListener('click', function() {
        // ایجاد یک شیء MediaRecorder برای ضبط ویدئو
        const mediaRecorder = new MediaRecorder(videoElement.srcObject);

        // آرایه برای ذخیره بلافاصله داده‌های ضبط شده
        let chunks = [];

        // رویداد استریم داده‌های ضبط شده
        mediaRecorder.ondataavailable = function(event) {
            chunks.push(event.data);
        };

        // رویداد پایان ضبط
        mediaRecorder.onstop = function() {
            // ایجاد یک لینک برای دانلود ویدئو
            const blob = new Blob(chunks, { type: 'video/mp4' });
            const videoUrl = URL.createObjectURL(blob);
            const downloadLink = document.createElement('a');
            downloadLink.href = videoUrl;
            downloadLink.download = 'recorded_video.mp4';
            downloadLink.textContent = 'دانلود ویدئو';
            document.body.appendChild(downloadLink);
        };

        // شروع ضبط ویدئو
        mediaRecorder.start();

        // تغییر متن دکمه به "توقف ضبط"
        recordButton.textContent = 'توقف ضبط';

        // رویداد کلیک بر روی دکمه توقف ضبط
        recordButton.addEventListener('click', function() {
            // توقف ضبط ویدئو
            mediaRecorder.stop();

            // تغییر متن دکمه به "ضبط"
            recordButton.textContent = 'ضبط';
        });
    });
} else {
    console.error('nooooooooo');
}