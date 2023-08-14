<div id="loading-overlay"></div>
<div id="loader" class="lds-dual-ring"></div>
<style>
    .lds-dual-ring {
        display: inline-block;
        width: 80px;
        height: 80px;
    }

    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 8px;
        border-radius: 50%;
        border: 6px solid #cef;
        border-color: #028074 transparent #314053 transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #wrapper {
        position: relative;
        /* Ensure overlay and spinner are positioned within this container */
        /* Your existing styles for the content container */
    }

    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(27, 27, 27, 0.10);
        /* Semi-transparent black background */
        z-index: 9999;
        /* Ensure it's above other content */
        /* display: none; Initially hidden */
        backdrop-filter: blur(5px);
        /* Apply blur effect to the overlay */
    }

    #loader {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10000;
        /* Ensure it's above the overlay */
        /* display: none; Initially hidden */
    }
</style>