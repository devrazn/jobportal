<script type="text/javascript">
    $(document).ready(function() {
      //alert("Delete?");

      var oTable = $('#dataTables-example').dataTable({
            responsive: true,
            "bProcessing": true,
            "bServerSide": true,
            "responsive": true,
            "sAjaxSource": '<?php echo base_url(); ?>admin/category/datatable',
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "oLanguage": {
                "sProcessing": "<img src='<?php echo base_url(); ?>assets/ajax/images/ajax-loader_dark.gif'>"
            },
            "fnInitComplete": function () {
                //oTable.fnAdjustColumnSizing();
            },
            'fnServerData': function (sSource, aoData, fnCallback) {
                $.ajax
                ({
                    'dataType': 'json',
                    'type': 'post',
                    'url': sSource,
                    'data': aoData,
                    'success': fnCallback
                });
            }
        });
    });
</script>

<div class="panel-heading">
  <a class="btn btn-primary" href="<?=base_url().'admin/category/add';?>">Add New</a>   
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?=$title?>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
          <div class="dataTable_wrapper">

            <?php //echo $this->table->generate(); ?>

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <!-- <th>Id</th> -->
                  <th>Name</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  <!-- <th>Options</th> -->
                </tr>
              </thead>
              <tbody>

              </tbody>
     
            </table>
		</div>
        <!-- dataTable_wrapper -->
	</div>
    <!-- panel-body -->
</div>
<!-- panel panel-default -->
            </div>
            <!-- col-lg-12 -->
            </div>
            <!-- row -->


<script>
function doConfirm() {
  msg=confirm("Are you sure you want to delete this Permanently?");
  if(msg != true) {
    return false;
  } else {
    return true;
    /*$(".delete").click(function(e){
      $this  = $(this);
      e.preventDefault();
      alert(url);
      var url = $(this).attr("href");
      $.get(url, function(r){
          if(r.success){
              $this.closest("tr").remove();
          }
      })
    });*/
  }
}
</script>
