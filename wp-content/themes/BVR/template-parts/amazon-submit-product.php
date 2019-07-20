<p>Submit the product’s URL on Amazon and we’ll tell you everything about the product</p>
	<img src="<?php bloginfo('template_url'); ?>/images/bg-product.png" class="stay_block_image_product"/>
	<span id="responseMsg"></span>
	<span id="errorMsg"></span>
	<div class="form-group custome-form-group">
	<form id="amazonProductForm" method="post">
     <div class="input-group">
         <input type="url" class="form-control custome-input-product" id="amazon_product_url" placeholder="Product Amazon URL">
         <span class="input-group-btn">
         <button class="btn" type="button" id="getModelBox" style="background-color: #63ccac;color:#fff;  width: 112px;height: 40px;border-radius: 2px;" data-toggle="modal" data-target="#productModal" disabled="disabled">Submit URL</button>
         </span>
		  </div>
    </div>
	</div>
	</div>
	
	</div>
	
	</div>

	 <!--  model dialog box start here -->
			<!-- Modal -->
			<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content stay_block_new ">
					<div class="modal-header" style="border-bottom:none;">
						<h5 class="modal-title" id="productModalLabel">Enter your Email</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-48px;">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="a_product_url" id="a_product_url">
						<input type="hidden" name="action" value="prod_submit_action">
						<input type="email" class="form-control custome-input" name="user_email" required="required">
						<?php wp_nonce_field( 'prod_submit_action_nonce', 'amazon_product_submit' ); ?>
					</div>
					<div class="modal-footer" style="border-top:none;">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit your Request</button>
					</div>
					</form>
					</div>
				</div>
				</div>
		  <!-- model dialog ends here -->
