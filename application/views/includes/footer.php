<?php if(!isset($hideFooter)) { ?>
<footer class="page-footer grey-text text-lighten-1 black punk">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="purple-text-logo text-darken-1">XLMwallet</h5> 
        <b>Donate:</b> <span style="word-wrap:break-word;">GDX4FNTXILYJDZMM5PWSYVX2UXXSWW7WTKBTSJKQ5U2OBFBYNPAMZSXW</span></p>
      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="grey-text">Links</h5>
        <ul>
          <li><a target="_blank" href="https://twitter.com/XLMwalletCo"><i class="fa fa-rocket white-text"></i> Twitter</a></li>
          <li><a target="_blank" href="https://galactictalk.org/d/1681-xlmwallet-convenient-account-viewer"><i class="fa fa-rocket white-text"></i> Galactictalk</a></li>
          <li><a target="_blank" href="https://github.com/XlmWalletCo/xlmwallet"><i class="fa fa-rocket white-text"></i> Github</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
    © Copyright 2018, XLMwallet - we are not affiliated with the Stellar Foundation.
    <a class="grey-text text-lighten-4 right" href="terms">Terms</a>
    </div>
  </div>
</footer>
<?php } ?>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>

<?php if(isset($loadBlackWalletJs)) {  ?>
<!-- load xlmwallet -->
<script type="text/javascript" src="assets/js/translation.js"></script>
<script type="text/javascript" src="assets/js/xlmwalletv1.js"></script>

<script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/currency.js"></script>
<?php } ?>

<?php if(isset($loadClaimJs)) {  ?>
<!-- load stellar sdk -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/stellar-sdk/0.7.3/stellar-sdk.min.js"></script>
<!-- load xlmwallet claim js -->
<script type="text/javascript" src="assets/js/claim.js"></script>
<?php } ?>


</body>
</html>