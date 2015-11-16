<?php 
/****
	views	: other/modal_view
	created	: 09-11-2015 12:23:12
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id='modalHead'><span class="glyphicon glyphicon-bell"></span> Hello World</h4>
        </div>
        <div class="modal-body">
<div id='modalBody'> </div>
		</div>
		 <div class="modal-footer">
         <span id='footerDetail'>You can put something here or don't use footer
		 klik outside window or click X above</span>
        </div>
      </div>
    </div>
  </div>