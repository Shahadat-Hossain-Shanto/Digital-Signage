<div id="parent-container" style="width: 100%; height: auto; position: relative; text-align: center; overflow: hidden;">
    <iframe
        id="dynamic-iframe"
        src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=&timezone=Asia%2FDhaka"
        style="
            width: 800px; 
            height: 600px; 
            border: none; 
            transform-origin: top left;"
        frameborder="0"
        seamless>
    </iframe>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const parent = document.getElementById('parent-container');
        const iframe = document.getElementById('dynamic-iframe');
        const originalWidth = 800; // Original width of the iframe content
        const originalHeight = 600; // Original height of the iframe content

        function adjustIframeScale() {
            const parentWidth = parent.offsetWidth;
            const scale = parentWidth / originalWidth;

            // Scale the iframe content
            iframe.style.transform = `scale(${scale})`;
            iframe.style.width = `${originalWidth}px`;
            iframe.style.height = `${originalHeight}px`;

            // Adjust the iframe's wrapper height to match the scaled height
            parent.style.height = `${originalHeight * scale}px`;
        }

        // Adjust scaling on load and window resize
        adjustIframeScale();
        window.addEventListener('resize', adjustIframeScale);
    });
</script>
