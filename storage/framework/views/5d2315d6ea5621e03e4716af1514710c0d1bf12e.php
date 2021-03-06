<?php $__env->startSection('search'); ?>

    <form action='<?php echo e(route("client.index")); ?>' method="get">
            <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="<?php echo app('translator')->get('site.search'); ?>" aria-label="Search" aria-describedby="basic-addon2" name="search" value="<?php echo e(request()->search); ?>">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit" id="Search">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
     </form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="container">

<?php if(session('success')): ?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> <?php echo e(session('success')); ?>

  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>



<?php endif; ?>


    <div class="panner ">
					<div class=" ">
                  		  <h2 class="d-inline <?php echo e(LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'float-right ' : ''); ?>">Clients</h2> <span> : <?php echo e($client->total()); ?></span>
                  		  </div>



<?php if(auth()->user()->hasPermissionTo('create_cli')): ?>
                    <div class="float-right">
                    		  <a href="<?php echo e(url('dashboard/client/create')); ?>" class="btn btn-primary ">
			  	                 <i class="fa fa-plus"> </i> Create New client
			                  </a>
                    </div>
                    <div class="clearfix mb-4"></div>
<?php endif; ?>

			<div class="jumbotron " style="background: #FFF; padding: 2rem 2rem">

	
		
  <?php if($client->count() == 0  ): ?>

       <h2 class="text-center">no data</h2>
   <?php else: ?>
			  <table class="table text-center">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>  
                <th scope="col">Link Orders</th>

   
		
<?php if(auth()->user()->hasAnyPermission(['update_cli','delete_cli'])): ?>
             
					      <th scope="col"><?php echo app('translator')->get('site.action'); ?></th>
<?php endif; ?>					      
					    </tr>
					  </thead>

					  <tbody>
					<?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clients): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <tr>
					      <td><?php echo $clients->id; ?></td>
                <td><?php echo $clients->name; ?></td>
                <td><?php echo $clients->phone; ?></td>
                <td><?php echo $clients->address; ?></td>
                <td>
          <?php if(auth()->user()->hasPermissionTo('create_ord')): ?>

                  <?php echo Form::open(['url' => route("order.create") ]); ?>

                    <?php echo method_field('get'); ?>
                    <input type="hidden" name="client_id" value="<?php echo e($clients->id); ?>">
                      
                    <?php echo Form::submit('Create Order',['class' => 'btn btn-success btn-sm']); ?>  
                  <?php echo Form::close(); ?>

           <?php endif; ?>      
                </td>

	
					      <td>
			<?php if(auth()->user()->hasPermissionTo('update_cli')): ?>		      	
					      	<a href="client/<?php echo e($clients->id); ?>/edit" class="btn btn-info">
					      		Edit <i class="fa fa-edit"> </i>
					      	</a>
			<?php endif; ?>	

			<?php if(auth()->user()->hasPermissionTo('delete_cli')): ?>		      	
			 	
            <form method="post" action="client/<?php echo e($clients->id); ?>" style="display: inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('delete'); ?>

                <button type="submit" class="btn btn-danger confirm">Delete </button>
            </form>




               
            <?php endif; ?>
					      </td>
					    </tr>
          


					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					  </tbody>
					</table>

<div class="d-flex justify-content-center mt-5">

	<?php echo e($client->appends(request()->query())->links()); ?>


	 </div>




  <div class="modal fade" id="logoutModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Delete" below if you are shore. Or "Cancel" to back</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

   

        </div>
      </div>
    </div>
  </div>




 <?php endif; ?>


			</div>



    </div>
			  <div class="clearfix"></div>








</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubuntu/F-DASHBOARD/resources/views/dashboard/client/index.blade.php ENDPATH**/ ?>