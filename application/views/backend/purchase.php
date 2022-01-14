<?php
    $this->load->view('backend/header');
    $this->load->view('backend/sidebar'); 
?>
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Purchase</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item ">Purchase</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">

                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a href="#" class="text-white"><i class="" aria-hidden="true"></i> Add Purchase</a></button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url()?>purchase/purchase" class="text-white"><i class="" aria-hidden="true"></i> Manage Purchase </a></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">                                
                                <h4 class="m-b-0 text-white">Manage Purchase <span class="pull-right"><?php date_default_timezone_set("Asia/Dhaka"); echo date("l jS \of F Y h:i:s A") ?></span></h4>
                            </div>                            
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example234" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <!--<th>ID </th>-->
                                                <th>Supplier Name</th>
                                                <th>Invoice No </th>
                                                <th>Purchase Date </th>
                                                <th>Details </th>
                                                <th>Total Amount </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($Purchase as $value): ?>
                                            <tr><!--
                                                <td><a href="Purchase_History?H=<?php echo base64_encode($value->p_id) ?>"><?php echo $value->p_id ?></a></td>-->
                                                <td><a href=""><?php echo $value->s_name ?></a></td>
                                                <td><a href="Purchase_History?H=<?php echo base64_encode($value->p_id) ?>"><?php echo $value->invoice_no ?></a></td>
                                                <td><?php echo date('d/M/Y',$value->pur_date) ?></td>
                                                <td><?php echo substr($value->pur_details,0,22).'...' ?></td>
                                                <td><?php echo $value->gtotal_amount ?></td>
                                                <td class="jsgrid-align-center ">
                                                   <a href="" title="Print Invoice" class="btn btn-sm btn-info waves-effect waves-light invoId" data-id="<?php echo $value->p_id; ?>"><i class="fa fa-history"></i></a> 
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        </div>
            <footer class="footer"> © 2017 GenIT Bangladesh </footer>
        </div>
<!--Invoice and print view Modal-->
<div class="modal fade" id="invoicemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="75%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="https://apotekroxy.com/assets/image/apotekroxy.png" height="80" width="110" style="margin-left:330px; width: 100%" alt="homepage" class="dark-logo" />
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="invoicedom">

      </div>
      <div class="modal-footer">
        <div class='text-right'>
            <input id='print' class='btn btn-default btn-outline print' type='submit' value='Print'>
        </div>
      </div>
    </div>
  </div>
</div>                       
           <script type="text/javascript">

        $(document).ready(function () {
            $(".invoId").click(function (e) {
                e.preventDefault(e);
                // Get the record's ID via attribute  
                var iid = $(this).attr('data-id');
                console.log(iid);
                $('#smodel').trigger("reset");
                $('#invoicemodal').modal('show'); 
                $.ajax({
                    url: '<?php echo base_url();?>Supplier/GetSupplierInvoice?id=' + iid,
                    method: 'GET',
                    data: 'html',
                    dataType: '',
                }).done(function (response) {
                    console.log(response);
                    $('#invoicedom').html(response);
                });
            });
        });   

            </script>
<script>
    $(document).ready(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div#invoicedom").printArea(options);
        });
    });
    </script>                      
 <?php 

    $this->load->view('backend/footer');

?>