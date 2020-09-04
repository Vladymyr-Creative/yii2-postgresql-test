<?php

use yii\widgets\Pjax;
use yii\web\View;

?>

    <h2>Title</h2>
    <span id="roku">roku</span>
<?php
$script = <<< JS
var elem = document.getElementById('roku');
elem.onclick = function() {
    console.log('click');
    data = {
        name:'dkk',
        age:90
    }
     $.ajax({
         url: '/post/submit',
         type: 'POST',
         data: data,
         success: function(res){
         console.log(res);
     },
     error: function(){
            alert('Error!');
         }
     });     
}
console.log(elem);






JS;

$this->registerJs($script);