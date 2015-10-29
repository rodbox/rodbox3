<?php if($c->isUser()): ?>
<div id="quicksidebar" class="quicksidebar pad-5">
<!-- BEGIN COL : col-md-8 col-lg-8  -->
<h1 class="small">Contacts</h1>
<?php $c->service("contactList"); ?>
<!-- END RB PORTLET : contact list -->
<!-- END COL : col-md-8 col-lg-8  -->
</div>
<?php endif; ?>