</body>
</html>

<script type="text/javascript">
    var message = '<?php echo json_encode($error); ?>';
    var mess = $.parseJSON(message);
    if(mess.success)
    {
        $("#message_success").show();
        setTimeout(function(){
            $("#message_success").toggle("show");
        },4000);
    }
    if(mess.error)
    {
        $("#message_error").show();
        setTimeout(function(){
            $("#message_error").toggle("show");
        },4000);
    }


    function updateDatabase(newLat, newLng)
    {
        // make an ajax request to a PHP file
        // on our site that will update the database
        // pass in our lat/lng as parameters
        $("#latitude").val(newLat);
        $("#longitude").val(newLng);
    }   
</script>