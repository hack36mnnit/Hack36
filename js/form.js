var div = $('.college').html();
var err = $('.error-clg').html();

//console.log(div);
$('#category').change(function(){
    // alert('srk');
    if($('#category').find(":selected").val() === 'Student'){
     $('.college').html(div);
     $('.error-clg').html(err);
        
    }
    else{
        $('.college').html('');
        $('.error-clg').html('');
    }
});