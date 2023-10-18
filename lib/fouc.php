<?php
add_action('wp_head', 'fouc_protect_against');

function fouc_protect_against()
{
?>
<script type="text/javascript">
var elm=document.getElementById("main-header");
if (elm) {
elm.style.display="none";
document.addEventListener("DOMContentLoaded",function(event) { elm.style.display="block"; });
}
</script>
<?php
}
