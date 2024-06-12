function updateDays() {
    var monthSelect = document.getElementById("month");
    var daySelect = document.getElementById("day");
    var month = monthSelect.value;
    var daysInMonth;

    // 根據月份設定天數
    if (month === "02") {
        var year = new Date().getFullYear();
        // 檢查是否為閏年
        daysInMonth = (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0) ? 29 : 28;
    } else if (["04", "06", "09", "11"].includes(month)) {
        daysInMonth = 30;
    } else {
        daysInMonth = 31;
    }

    // 清空現有的日期選項
    daySelect.innerHTML = "";
    // 根據天數生成新的日期選項
    for (var d = 1; d <= daysInMonth; d++) {
        var day = String(d).padStart(2, '0');
        var option = document.createElement("option");
        option.value = day;
        option.text = d;
        daySelect.add(option);
    }
}

// 初始化日期選項
document.addEventListener("DOMContentLoaded", function() {
    updateDays(); // 初始載入根據當前月份設置天數
    document.getElementById("month").addEventListener("change", updateDays);
});
