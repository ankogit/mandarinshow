<script type="text/javascript">
    
var logged = "<?=$_SESSION['logged']?>"; 
function count_message() {
    $.get('/counter', function ( data ) {

        
            $('#counter').html( data );
        
    })
}

 $(document).ready(function() {
    if( logged == 'TRUE') { 
    count_message();
    setInterval('count_message()',3000);  
    } else { 

} 
 });

 </script>