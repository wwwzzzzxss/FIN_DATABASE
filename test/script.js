document.addEventListener('DOMContentLoaded', function () {
    let options = {
        canvasId: "auth-code", // canvas ID
        txt: (randomNum(100000, 999999)).toString(), // verification code content
        height: 50, // verification code height
        width: 200, // verification code width
        fontColor1: 0, // random font color range start
        fontColor2: 50, // random font color range end
        bgColor1: 180, // random background color range start
        bgColor2: 255, // random background color range end
        fontStyle: "24px SimHei" // font style
    };

    // Generate a new CAPTCHA when the button is clicked
    var $btn = document.getElementById("reBtn");
    $btn.addEventListener('click', () => {
        options.txt = (randomNum(100000, 999999)).toString();
        helper = new writeAuthCode(options);
        document.getElementById('result').innerHTML = "";
        document.getElementById('validText').value = "";
    });

    // Validate the input against the CAPTCHA
    var $text = document.getElementById('validText');
    var isValid = false;
    $text.addEventListener('keyup', function () {
        if (helper.validate($text.value)) {
            document.getElementById('verify_code').innerHTML = "驗證碼<span>*</span>";
            document.getElementById('verify_code').style.color = "#393939";
            isValid = true;
            console.log('驗證碼輸入正確');
        } else {
            document.getElementById('verify_code').innerHTML = "驗證碼錯誤";
            document.getElementById('verify_code').style.color = "#FF435E";
            isValid = false;
        }
    });

    // CAPTCHA generation function
    function writeAuthCode(options) {
        this.options = options;
        let canvas = document.getElementById(options.canvasId);
        canvas.width = options.width || 300;
        canvas.height = options.height || 150;
        let ctx = canvas.getContext('2d'); // Create canvas object
        ctx.textBaseline = "middle";
        ctx.fillStyle = randomColor(options.bgColor1, options.bgColor2);
        ctx.fillRect(0, 0, options.width, options.height);
        for (let i = 0; i < options.txt.length; i++) {
            let txt = options.txt.charAt(i); // Make each character different
            ctx.font = options.fontStyle;
            ctx.fillStyle = randomColor(options.fontColor1, options.fontColor2);
            ctx.shadowOffsetY = randomNum(-3, 3);
            ctx.shadowBlur = randomNum(-3, 3);
            ctx.shadowColor = "rgba(0, 0, 0, 0.3)";
            let x = options.width / (options.txt.length + 1) * (i + 1);
            let y = options.height / 2;
            let deg = randomNum(-30, 30);
            // Set rotation angle and origin
            ctx.translate(x, y);
            ctx.rotate(deg * Math.PI / 180);
            ctx.fillText(txt, 0, 0);
            // Restore rotation angle and origin
            ctx.rotate(-deg * Math.PI / 180);
            ctx.translate(-x, -y);
        }
        // Draw 1-4 random interference lines
        for (let i = 0; i < randomNum(1, 4); i++) {
            ctx.strokeStyle = randomColor(40, 180);
            ctx.beginPath();
            ctx.moveTo(randomNum(0, options.width), randomNum(0, options.height));
            ctx.lineTo(randomNum(0, options.width), randomNum(0, options.height));
            ctx.stroke();
        }
        // Draw interference points
        for (let i = 0; i < options.width / 6; i++) {
            ctx.fillStyle = randomColor(0, 255);
            ctx.beginPath();
            ctx.arc(randomNum(0, options.width), randomNum(0, options.height), 1, 0, 2 * Math.PI);
            ctx.fill();
        }
        this.validate = function (code) {
            return this.options.txt === code;
        }
    }

    // Generate a random number
    function randomNum(min, max) {
        return Math.floor(Math.random() * (max - min) + min);
    }

    // Generate a random color
    function randomColor(min, max) {
        let r = randomNum(min, max);
        let g = randomNum(min, max);
        let b = randomNum(min, max);
        return `rgb(${r},${g},${b})`;
    }

    var helper = new writeAuthCode(options);
});
