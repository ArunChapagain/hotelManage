<?php
require('./config.php');
?>

<form action="submit.php" method="post">
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo $Publishable_key ?>"
    data-amount="500"
    data-name="suman"
    data-description="this is arun chapagain"
    data-image=""
    data-currency="USD"
    data-email="mike2074don@gmail.com"
    
    >
        </script>
</form>