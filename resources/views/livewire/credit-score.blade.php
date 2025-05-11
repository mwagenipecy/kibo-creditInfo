<div>

<div class="w-full flex gap-4 p-2">
        <div class="w-3/3">
            <p for="stability" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">CREDIT SCORE</p>
            <div id="stability" class="w-full bg-gray-50 rounded rounded-lg shadow-sm   p-1 mb-4" >
                <div class="w-full bg-white rounded-lg shadow-sm p-2 flex flex-col items-center justify-center">
                    <canvas id="demo" width="400" height="200"></canvas>
                    <div id="preview-textfield" class="text-center mt-2 font-bold"></div>
                </div>
            </div>
        </div>
    </div>

    
<script>
var opts = {
    angle: 0.15,
    lineWidth: 0.44,
    radiusScale: 1.0,
    pointer: {
        length: 0.6,
        strokeWidth: 0.035,
        iconScale: 1.0
    },
    staticLabels: {
        font: "10px sans-serif",
        labels: [250, 530, 574, 641, 689, 743, 900],
        fractionDigits: 0
    },
    staticZones: [
        {strokeStyle: "#FF0000", min: 250, max: 573},  // Very High Risk (E)
        {strokeStyle: "#FFA500", min: 574, max: 640},  // High Risk (D)
        {strokeStyle: "#FFFF00", min: 641, max: 676},  // Average Risk (C)
        {strokeStyle: "#00FF7F", min: 677, max: 712},  // Low Risk (B)
        {strokeStyle: "#00FF00", min: 713, max: 900}   // Very Low Risk (A)
    ],
    
    renderTicks: {
        divisions: 15,
        divWidth: 1.1,
        divLength: 0.7,
        divColor: "#333333",
        subDivisions: 3,
        subLength: 0.5,
        subWidth: 0.6,
        subColor: "#666666"
    },
    colorStart: "#6fadcf",
    colorStop: "#8cf",
    strokeColor: "#e0e0e0",
    generateGradient: true,
    highDpiSupport: true
};

var target = document.getElementById('demo');
var gauge = new Gauge(target).setOptions(opts);

document.getElementById("preview-textfield").className = "preview-textfield";
gauge.setTextField(document.getElementById("preview-textfield"));

gauge.maxValue = 900;
gauge.setMinValue(250);
gauge.set(640); // Set an initial value, e.g., 640 for D1 - High Risk
gauge.animationSpeed = 32;
</script>



</div>
