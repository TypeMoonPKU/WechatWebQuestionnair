<?php
/**
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 5/10/2016
 * Time: 22:53
 */
?>
<form method="get" action="var_dump.php">
<div class="form-group">
    <label for="question_desc" class="col-sm-2 control-label">题目</label>
    <div class="col-sm-10">
        <p class="form-control-static" id="questionDescription">您可以来参加家长会的时间</p>
        <input type="checkbox"  name="optionsCheckboxA" id="optionsCheckboxA" value="optionA"><label for="optionsCheckboxA" id="optionsCheckboxALabel">A.正在加载</label><br>
        <input type="checkbox"  name="optionsCheckboxB" id="optionsCheckboxB" value="optionB"><label for="optionsCheckboxB" id="optionsCheckboxBLabel">B.正在加载</label><br>
        <input type="checkbox"  name="optionsCheckboxC" id="optionsCheckboxC" value="optionC"><label for="optionsCheckboxC" id="optionsCheckboxCLabel">C.正在加载</label><br>
        <input type="checkbox"  name="optionsCheckboxD" id="optionsCheckboxD" value="optionD"><label for="optionsCheckboxD" id="optionsCheckboxDLabel">D.正在加载</label><br>
    </div>
    <button type="submit" class="btn btn-large btn-block">确认提交</button>
</form>
<script>
    document.getElementById('optionsCheckboxA').value = 'setA';
</script>