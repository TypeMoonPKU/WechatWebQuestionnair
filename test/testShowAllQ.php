<script>
    var $jsondata=$.parseJSON('<?PHP
        echo "begin";
        require_once "../reg/showAllQuestionnaire.php";
        echo "middle";
$questionnaireJSON=showAllQuestionnaire("oG_07xPR4JEibyjiSzTjfphx6EWM");
        echo "end";
echo $questionnaireJSON;
?>');


</script>
