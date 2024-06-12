<?php
// 定义条件变量，true 表示禁用，false 表示不禁用
$shouldDisable = true; // 可以根据具体逻辑设置该变量的值

// 地址内容
$address = "Some address";
?>

<div class="row">
    <div class="input-field col s12">
        <img src="images/address.png" class="prefix" alt="Description of image">
        <textarea name="address" id="address" class="materialize-textarea validate" data-error=".errorTxt1"
        <?php if ($shouldDisable) echo 'disabled'; ?>><?php echo $address; ?></textarea>
        <label for="address" class="">Address</label>
        <div class="errorTxt1"></div>
    </div>
</div>
