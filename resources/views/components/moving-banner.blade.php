<div class="moving-banner">
    <span class="banner-content">{{ $banner }}</span>
</div>

<style>
.moving-banner {
    position: relative;
    overflow: hidden; /* Ensures content doesn't overflow */
    white-space: nowrap;
    width: 100%; /* Matches the parent container's width */
    background-color: #007bff; /* Blue background */
    padding: 10px;
    color: #fff; /* White text color */
    border-radius: 5px; /* Rounded corners */
}

.banner-content {
    display: inline-block;
    animation: move-left 10s linear infinite; /* Moves the content */
    font-size: clamp(1rem, 2.5vw, 2rem); /* Dynamically adjusts font size */
    font-weight: bold;
}

@keyframes move-left {
    from {
        transform: translateX(100%); /* Start outside the right edge */
    }
    to {
        transform: translateX(-100%); /* Move completely outside the left edge */
    }
}
</style>
