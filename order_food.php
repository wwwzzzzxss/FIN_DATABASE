<?php
include 'includes/connect.php';

if ($con == null) {
    die("数据库连接未成功建立");
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="menu.css">
    <!-- JQuery連結 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JS連結 -->
    <script src="menu_script.js"></script>
    <!-- FontAwesome 連結 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap 連結 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-all">
        <div class="container-left">
              <!--   導覽列 -->
            <nav id="sidebar">
                <!-- 展開/縮起來 按鈕 -->
                <button type="button" id="collapse" class="collapse-btn">
                    <i class="fas fa-align-left"></i>
                </button>
                <!-- List 列表 -->
                <ul class="list-unstyled">
                    <li>
                        <a href="#"><i class="fas "></i><?php echo $name;?></a>
                    </li>
                    <li>
                        <a href="index.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i>訂餐方式</a>
                    </li>
                    <li>
                        <a href="#sublist1" data-bs-toggle="collapse" id="dropdown">訂單 <i class="fas fa-angle-down"></i></a>
                        <!-- 子選單列表 -->
                        <ul id="sublist1" class="list-unstyled collapse">
                            <li><a href="orders.php">所有訂單</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#sublist2" data-bs-toggle="collapse" id="dropdown">問題 <i class="fas fa-angle-down"></i></a>
                        <!-- 子選單列表 -->
                        <ul id="sublist2" class="list-unstyled collapse">
                            <li><a href="tickets.php">所有問題</a></li>
                            
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
         
        
        <div class="container-right">
            <div class="tab-menu">
                <div class="active" onclick="scrollToSection('section-noodle', this)">麵</div>
                <div onclick="scrollToSection('section-rice', this)">飯</div>
                <div onclick="scrollToSection('section-drink', this)">飲料</div>
            </div>

            <form action="place-order.php" method="post" onsubmit="return validateForm()">
                <input type="hidden" name="order_type" value="<?php echo $_POST['order_type']; ?>">
                <div id="section-noodle" class="menu-section active">
                    <h3 class="H3">麵</h3>
                    <?php
                        $result = mysqli_query($con, "SELECT * FROM items WHERE type = 'N';");
                        while($row = mysqli_fetch_array($result)) {
                            echo '<div class="menu-item">';
                            echo '<div class="item-info">'.$row["name"].' - $'.$row["price"].'</div>';
                            echo '<div class="quantity-controls">';
                            echo '<button type="button" onclick="decrementQuantity(\'item'.$row["it_id"].'\')">-</button>';
                            echo '<input type="number" name="items['.$row["it_id"].'][quantity]" id="item'.$row["it_id"].'" value="0" min="0" oninput="if(value>20)value=20">';
                            echo '<button type="button" onclick="incrementQuantity(\'item'.$row["it_id"].'\')">+</button>';
                            echo '</div></div>';
                            
                        }
                    ?>
                </div>

                <div id="section-rice" class="menu-section">
                    <h3 class="H3">飯</h3>
                    <?php
                        $result = mysqli_query($con, "SELECT * FROM items WHERE type = '';");
                        while($row = mysqli_fetch_array($result)) {
                            echo '<div class="menu-item">';
                            echo '<div class="item-info">'.$row["name"].' - $'.$row["price"].'</div>';
                            echo '<div class="quantity-controls">';
                            echo '<button type="button" onclick="decrementQuantity(\'item'.$row["it_id"].'\')">-</button>';
                            echo '<input type="number" name="items['.$row["it_id"].'][quantity]" id="item'.$row["it_id"].'" value="0" min="0" oninput="if(value>20)value=20">';
                            echo '<button type="button" onclick="incrementQuantity(\'item'.$row["it_id"].'\')">+</button>';
                            echo '</div>';
                            echo '<div class="options">';
                            echo '<label for="nood_type'.$row["it_id"].'">麵種類:</label>';
                            echo '<select name="items['.$row["it_id"].'][nood_type]" id="nood_type'.$row["it_id"].'">';             
                            echo '<option value="knife">刀削麵</option>';
                            echo '<option value="yi">意麵</option>';
                            echo '<option value="udon">烏龍麵</option>';
                            echo '</select>';
                            echo '</div></div>';

                            
                        }
                    ?>
                </div>

                <div id="section-drink" class="menu-section">
                    <h3 class="H3">飲料</h3>
                    <?php
                        $result = mysqli_query($con, "SELECT * FROM items WHERE type = 'D';");
                        while($row = mysqli_fetch_array($result)) {
                            echo '<div class="menu-item">';
                            echo '<div class="item-info">'.$row["name"].' - $'.$row["price"].'</div>';
                            echo '<div class="quantity-controls">';
                            echo '<button type="button" onclick="decrementQuantity(\'item'.$row["it_id"].'\')">-</button>';
                            echo '<input type="number" name="items['.$row["it_id"].'][quantity]" id="item'.$row["it_id"].'" value="0" min="0" oninput="if(value>20)value=20">';
                            echo '<button type="button" onclick="incrementQuantity(\'item'.$row["it_id"].'\')">+</button>';
                            echo '</div>';

                            echo '<div class="options">';
                            echo '<label for="sweet'.$row["it_id"].'">甜度:</label>';
                            echo '<select name="items['.$row["it_id"].'][sweet]" id="sweet'.$row["it_id"].'">';
                            echo '<option value="regular">正常甜</option>';
                            echo '<option value="less_sugar">少糖</option>';
                            echo '<option value="half_sugar">半糖</option>';
                            echo '<option value="quarter_sugar">微糖</option>';
                            echo '<option value="no_sugar">無糖</option>';
                            echo '</select>';

                            echo '<label for="ice'.$row["it_id"].'">冰塊:</label>';
                            echo '<select name="items['.$row["it_id"].'][ice]" id="ice'.$row["it_id"].'">';
                            echo '<option value="regular">正常冰</option>';
                            echo '<option value="less_ice">少冰</option>';
                            echo '<option value="half_ice">半冰</option>';
                            echo '<option value="quarter_ice">微冰</option>';
                            echo '<option value="no_ice">去冰</option>';
                            echo '</select>';
                            echo '</div></div>';
                        }
                    ?>
                </div>
                <div style="text-align: center;">
                    <button type="submit" class="order-btn">提交訂單</button>
                </div>
            </form>
        </div> 
    </div>

    <script>
        function validateForm() {
            var quantities = document.querySelectorAll('input[type="number"]');
            var total = 0;
            quantities.forEach(function(input) {
                total += parseInt(input.value);
            });
            if (total === 0) {
                alert("請至少選擇一項商品的數量。");
                return false;
            }
            return true;
        }

        function incrementQuantity(id) {
            var input = document.getElementById(id);
            input.value = parseInt(input.value) + 1;
        }

        function decrementQuantity(id) {
            var input = document.getElementById(id);
            if (input.value > 0) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function scrollToSection(sectionId, element) {
            var offset = 20; // 調整的距離值，可以根據需要修改
            document.querySelectorAll('.tab-menu div').forEach(function(tab) {
                tab.classList.remove('active');
            });
            element.classList.add('active');
            
            var section = document.getElementById(sectionId);
            var scrollPosition = section.offsetTop - document.querySelector('.tab-menu').offsetHeight - offset;
            window.scrollTo({
                top: scrollPosition,
                behavior: 'smooth'
            });
        }

        function validateQuantity(input) {
            input.value = input.value.replace(/[^\d]/g, '');
            if (input.value > 10) {
                input.value = 10;
            }
        }
    </script>
</body>
</html>
