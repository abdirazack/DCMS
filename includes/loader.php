<div id="loading-overlay"></div>
<div id="loader" class="lds-ripple">
    <div></div>
    <div></div>
</div>
<style>
    .lds-ripple {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-ripple div {
        position: absolute;
        border: 4px solid #028074;
        opacity: 1;
        border-radius: 50%;
        animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
    }

    .lds-ripple div:nth-child(2) {
        animation-delay: -0.5s;
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
        background-color: rgba(27, 27, 27, 0.269);
        /* Semi-transparent black background */
        z-index: 9999;
        /* Ensure it's above other content */
        /* display: none; Initially hidden */
        backdrop-filter: blur(10px);
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

    @keyframes lds-ripple {
        0% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 0;
        }

        4.9% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 0;
        }

        5% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 1;
        }

        100% {
            top: 0px;
            left: 0px;
            width: 72px;
            height: 72px;
            opacity: 0;
        }
    }
</style>