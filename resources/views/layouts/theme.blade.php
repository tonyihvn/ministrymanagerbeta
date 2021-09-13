<!doctype html>
<html lang="en">

<head>
	<title>CRM Church Manager | Dashboard</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}">
	

	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
	<link rel="icon" type="{{ asset('image/png" sizes="96x96" href="assets/img/favicon.png') }}">

	
    <link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css')}}">
	<style>
		@media only screen and (max-width: 900px) {
			table {
				display: block;
				overflow-x: auto;
				white-space: nowrap;
			}

			table tbody {
				display: table;
				width: 100%;
			}
		}
        #cover {
			background: url("{{asset('/images/ajax-loader.gif')}}") no-repeat scroll center center #CCC;
			position: absolute;
			height: 100%;
			width: 100%;
			z-index: 999999999;
			opacity: 0.8;
		}
	</style>
</head>

<body>
<div id="cover"></div>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="/"><img  src="/images/{{$settings->logo}}" alt="{{$settings->motto}}" class="img-responsive logo" style="height: 35px !important; float: left;"></a> {{$settings->ministry_name}}
			</div>
			<div class="container-fluid" style="width: 100%">
				

				
				
				<form class="navbar-form navbar-left" action="{{ route('searchmembers') }}" method="post">
					@csrf
					<div class="input-group">
						<input type="text" value="" name="keyword" class="form-control" placeholder="Search Members...">
						<span class="input-group-btn"><button type="submit" class="btn btn-primary">Go</button></span>
					</div>
				</form>

				
				
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
                    <li>
                   
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-menu"></i></button>
	
                    </li>

						@auth
						<li class="dropdown">					
								
							
								<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
									<i class="lnr lnr-alarm"></i>
									@if ($mytasks->count()>0)
										<span class="badge bg-danger">{{$mytasks->count()}} <!-- Some Laravel Counter --></span>
									@endif
								</a>
							
							
							<ul class="dropdown-menu notifications">
								@foreach ($mytasks as $ts)									
									<li><a href="/tasks" class="notification-item"><span class="dot bg-warning"></span>{{$ts->title}} | <i class="lnr lnr-clock"></i>{{$ts->date}}</a></li>
								@endforeach
								<li><a href="/tasks" class="more">See all notifications</a></li>
							</ul>
						</li>
						@endauth
						<li>
							<a href="/"><i class="lnr lnr-home"></i> <span>Home</span></a>
							
						</li>

						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="lnr lnr-user"></i> <span>@auth {{ Auth::user()->name }} @endauth </span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a class="btn btn-success update-pro" href="/add-new" title="New Member" target="_blank" style="color: white; font-weight: bold;"><span class="fa fa-user-plus"></span> <span>New Member</span></a></li>
								<li><a href="/my_profile/{{$login_user->id ?? ''}}"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="/tasks"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>

								<li class="roledlink Admin Followup Super" style="visibility:hidden !important;"><a href="#"  data-toggle="modal" data-target="#settings"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
								<li><a href="/help"><i class="lnr lnr-bubble"></i> Basic Use</a></li>
								<li><a href="/security"><i class="lnr lnr-lock"></i> Security</a></li>
								<li><a href="/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>


						
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar" style="margin-top: 10px">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/home" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						
						<li class="roledlink Worker Admin Followup Pastor Finance Super" style="visibility:hidden !important;">
							<a href="#subPages1" data-toggle="collapse" class="collapsed"><i class="lnr lnr-calendar-full"></i> <span>Tasks/ To Do</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages1" class="collapse ">
								<ul class="nav">
									<li><a href="/tasks" class="">Manage Tasks/TODOs</a></li>
								</ul>
							</div>
						</li>
						<li class="roledlink Worker Admin Followup Pastor Finance Super" style="visibility:hidden;">
							<a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i> <span>Members</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages2" class="collapse ">
								<ul class="nav">
									<li><a href="/members" class="">View Members</a></li>
									<li><a href="/add-new" class="roledlink Worker,Admin,Followup,Pastor,Super">Add New</a></li>
									
								</ul>
							</div>
						</li>
						<li class="roledlink Admin Super Pastor" style="visibility:hidden;">
							<a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-briefcase"></i> <span>Ministries</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages3" class="collapse ">
								<ul class="nav">
									<li><a href="/ministries" class="roledlink Admin Super Pastor">Manage Ministries</a></li>
									
								</ul>
							</div>
						</li>
						<li class="roledlink Admin Super Pastor" style="visibility:hidden;">
							<a href="#subPages4" data-toggle="collapse" class="collapsed"><i class="lnr lnr-home"></i> <span>House Fellowships</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages4" class="collapse ">
								<ul class="nav">
									<li><a href="/house-fellowships" class="">Manage House Fellowships</a></li>
									
									
								</ul>
							</div>
						</li>
						<li class="roledlink Admin Super Pastor" style="visibility:hidden;">
							<a href="#subPages5" data-toggle="collapse" class="collapsed"><i class="lnr lnr-flag"></i> <span>Programs/Activities</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages5" class="collapse ">
								<ul class="nav">
									<li><a href="/programmes" class="">Manage Programmes</a></li>
									
								</ul>
							</div>
						</li>
						<li class="roledlink Admin Super Pastor Usher" style="visibility:hidden;">
							<a href="#subPages6" data-toggle="collapse" class="collapsed"><i class="lnr lnr-checkmark-circle"></i> <span>Attendance</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages6" class="collapse ">
								<ul class="nav">
									<li><a href="/attendance" class="">Manage Attendance</a></li>
								</ul>
							</div>
						</li>
						<li class="roledlink Admin Super Super" style="visibility:hidden;">
							<a href="#subPages7" data-toggle="collapse" class="collapsed"><i class="lnr lnr-list"></i> <span>Finance</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages7" class="collapse ">
								<ul class="nav">
									<li><a href="/transactions" class="">Financial Records</a></li>									
									<li><a href="/account-heads" class="">Manage Account Heads</a></li>									

								</ul>
							</div>
						</li>
						<li class="roledlink Admin Super Pastor" style="visibility:hidden;">
							<a href="#subPages8" data-toggle="collapse" class="collapsed"><i class="lnr lnr-envelope"></i> <span>Communication</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages8" class="collapse ">
								<ul class="nav">
									<li><a href="/communications" class="">Send Bulk SMS</a></li>
									<li><a href="/sentmessages" class="">Sent Messages</a></li>									
								</ul>
							</div>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main" style="padding-top: 30px !important">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-----------------------------START YIELD PAGE CONTENT -->
					@if (Session::get('message'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							<i class="fa fa-check-circle"></i> {!!Session::get('message')!!}
						</div>
					@endif
					@yield('content')

					<!----------------------------END YIELD PAGE CONTENT -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; {{date("Y")}} <a href="https://www.crmfct.org" target="_blank">CRM - FCT 2</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{asset('/assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('/assets/scripts/klorofil-common.js')}}"></script>
	<script src="{{asset('/assets/scripts/jquery-ui.js')}}"></script>
	<script>
		$( function() {
		  $( "#date,#from,#to,#dob" ).datepicker({dateFormat: "yy/mm/dd"});

		  $(".ui-datepicker, .ui-widget").draggable().selectable();
		});
	</script>
</body>

</html>

<!-- The Settings Modal -->
<div class="modal" id="settings">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            
            <form method="POST" action="{{ route('settings') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id" value="{{$settings->id}}">

				<input type="hidden" name="oldlogo" id="id" value="{{$settings->logo}}">

				<input type="hidden" name="oldbackground" id="id" value="{{$settings->background}}">
                                
                <div class="form-group">
                    <label for="ministry_name">Ministry / Church Name</label>
                    <input type="text" name="ministry_name" id="ministry_name" class="form-control" value="{{$settings->ministry_name}}">
                </div>

				<div class="form-group">
                    <label for="motto">Motto</label>
                    <input type="text" name="motto" id="motto" class="form-control" value="{{$settings->motto}}">
                </div>

				<div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{$settings->address}}">
                </div>

			
                

                <div class="form-group">
                    <label for="logo">Upload Logo Image</label>
                    <input type="file" name="logo" id="logo" class="form-control">
                </div>

				<div class="form-group">
                    <label for="background">Upload Background Image</label>
                    <input type="file" name="background" id="background" class="form-control">
                </div>

				<div class="form-group">
				  <label for="mode">Mode</label>
				  <select class="form-control" name="mode" id="mode">
					  <option value="{{$settings->mode}}">{{$settings->mode}}</option>
					<option value="Active" selected>Active</option>
					<option value="Maintenance">Maintenance</option>
				  </select>
				</div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save Settings') }}
                    </button>
                </div>

                  
            </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>

@if (isset($pagename) && $pagename=="dashboard")
	<script src="{{asset('/js/highcharts.js')}}"></script>
	

	<script>
		
		$(function () {
     
			var dates = [<?php echo $dates; ?>];
			var totals = [<?php echo $totals; ?>];
			var midweek = [<?php echo $midweek; ?>];
			

			console.log(dates);
			$('#attendance-chart').highcharts({
				chart: {
				type: 'line'
				},
				title: {
				text: 'Sunday Service Attendance Chart'
				},
				xAxis: {
				categories: dates
				},
				yAxis: {
					title: {
					text: 'Attendance'
				}
				},
				series: [
				{
				name: 'Sunday Services',
				data: totals
				},
				{
				name: 'Men',
				data: midweek
				}]
			});
		});

		/*

		series: [{
				name: 'Dates',
				data: dates
				},
				{
				name: 'Totals',
				data: totals
				}]
			*/

	</script>
@endif
@if (isset($pagetype) && $pagetype=="report")

	<script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>

    <script src="{{asset('/js/dataTables.fixedHeader.min.js')}}"></script>

    <script src="{{asset('/js/dataTables.select.min.js')}}"></script>

    <script src="{{asset('/js/dataTables.searchPanes.min.js')}}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js" /></script>

	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js" /></script>

	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js" /></script>

	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js" /></script>

	<script>
		

		// TABLES WITH FILTERS
		$('#products thead tr').clone(true).appendTo( '#products thead' );
		$('#products thead tr:eq(1) th:not(:last)').each( function (i) {
			var title = $(this).text();
			$(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" value="" />' );
			
			$( 'input', this ).on( 'keyup change', function () {
				if ( table.column(i).search() !== this.value ) {
					table
						.column(i)
						.search( this.value )
						.draw();
				}
			} );
		} );


		var table = $('#products').DataTable( {
			orderCellsTop: true,
			fixedHeader: true,
			"order": [[ 2, "asc" ]],
			"paging": false,
			"pageLength": 50,
			"filter": true,
			"ordering": true,
			deferRender: true,
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
		} );
	</script>
@endif


	<script>
		function accountHead(accid){
			
				
				
					var title = $('#ach'+accid).attr("data-title");
					var category = $('#ach'+accid).attr("data-category");
					var type = $('#ach'+accid).attr("data-type");
					var description = $('#ach'+accid).attr("data-description");
					
					$('#id').val(accid);
					$('#title').val(title);
					$('#category').val(category).attr("selected", "selected");
					$('#type').val(type);
					$('#description').val(description);
				
			
		}

		function attendance(accid){
			
				
				
			var date = $('#ach'+accid).attr("data-date");
			var activity = $('#ach'+accid).attr("data-activity");
			var men = $('#ach'+accid).attr("data-men");
			var women = $('#ach'+accid).attr("data-women");
			var children = $('#ach'+accid).attr("data-children");
			var remarks = $('#ach'+accid).attr("data-remarks");
			
			$('#id').val(accid);
			$('#date').val(date);
			$('#activity').val(activity).attr("selected", "selected");
			$('#men').val(men);
			$('#women').val(women);
			$('#children').val(children);
			$('#remarks').val(remarks);
			
		}

		function transaction(accid){
			
				
			var title = $('#ach'+accid).attr("data-title");
			var date = $('#ach'+accid).attr("data-date");
			var account_head = $('#ach'+accid).attr("data-account_head");
			var amount = $('#ach'+accid).attr("data-amount");
			var reference_no = $('#ach'+accid).attr("data-reference_no");
			var detail = $('#ach'+accid).attr("data-detail");
			var from = $('#ach'+accid).attr("data-from");
			var to = $('#ach'+accid).attr("data-to");
			var approved_by = $('#ach'+accid).attr("data-approved_by");
			var recorded_by = $('#ach'+accid).attr("data-recorded_by");
			
			$('#title').val(title);
			$('#id').val(accid);
			$('#date').val(date);
			$('#account_head').val(account_head).attr("selected", "selected");
			$('#amount').val(amount);
			$('#reference_no').val(reference_no);
			$('#detail').val(detail);
			$('#from').val(from).attr("selected", "selected");
			$('#to').val(to).attr("selected", "selected");
			$('#approved_by').val(approved_by).attr("selected", "selected");
			$('#recorded_by').val(recorded_by).attr("selected", "selected");
			
		}

		function ministry(accid){
			
				
				
			var name = $('#ach'+accid).attr("data-name");
			var details = $('#ach'+accid).attr("data-details");
			var leader = $('#ach'+accid).attr("data-leader");
			var activities = $('#ach'+accid).attr("data-activities");
			
			$('#id').val(accid);
			$('#name').val(name);
			$('#details').val(details);
			$('#leader').val(leader).attr("selected", "selected");
			$('#activities').text(activities);
			
		}

		function hfellowship(accid){
			
				
				
			var name = $('#ach'+accid).attr("data-name");
			var about = $('#ach'+accid).attr("data-about");
			var location = $('#ach'+accid).attr("data-location");
			var about = $('#ach'+accid).attr("data-about");

			var leader = $('#ach'+accid).attr("data-leader");
			var activities = $('#ach'+accid).attr("data-activities");
			
			$('#id').val(accid);
			$('#name').val(name);
			$('#location').val(location);
			$('#address').val(address);
			$('#about').val(about);
			$('#leader').val(leader).attr("selected", "selected");
			$('#activities').text(activities);
			
		}

		function programme(accid){
			
				
				
			var title = $('#ach'+accid).attr("data-title");
			var type = $('#ach'+accid).attr("data-type");
			var from = $('#ach'+accid).attr("data-from");
			var to = $('#ach'+accid).attr("data-to");

			var details = $('#ach'+accid).attr("data-details");
			var category = $('#ach'+accid).attr("data-category");
			var ministry = $('#ach'+accid).attr("data-ministry");
			
			$('#id').val(accid);
			$('#title').val(title);
			$('#type').val(type).attr("selected", "selected");
			$('#from').val(from);
			$('#to').val(to);
			$('#details').val(details);
			$('#category').val(category).attr("selected", "selected");
			$('#ministry').val(ministry).attr("selected", "selected");
			
		}

		function addnumber(number){
			var receivers = $('#recipients').val();

			if(number=="all"){
				
				if(receivers==""){
					$('#recipients').val($('#all').attr('data-allnumbers'));
				}else{
					$('#recipients').val('');
				}

				
			}else{
				if($("#recipients").val().indexOf(','+number) >= 0){

					
					
					$('#recipients').val(receivers.replace(','+number,''));
						
				}else if($("#recipients").val().indexOf(number+',') >= 0){
					
					
					$('#recipients').val(receivers.replace(number+',',''));
					
				}else if($("#recipients").val().indexOf(number) >= 0){
					
					
					$('#recipients').val(receivers.replace(number,''));
					
				}else{
					if(receivers==""){
						
						$('#recipients').val(number);
					}else{
						$('#recipients').val(receivers+','+number);
					}
					
				}
			}
				
		}

		// CHECK ALL
		$('#all').click(function(event) {   
			if(this.checked) {
				// Iterate each checkbox
				$(':checkbox').each(function() {
					this.checked = true;                        
				});
			} else {
				$(':checkbox').each(function() {
					this.checked = false;                       
				});
			}
		});

		// TEXT AREA Counter
		$('#body').on("input", function(){
			var maxlength = $(this).attr("maxlength");
			var currentLength = $(this).val().length;

			$("#charcounter").text(currentLength + " characters");
			$("#pagecounter").text(Math.ceil(currentLength/160) + " pages");
				

			if( currentLength >= maxlength ){
				$("#error").text("You have reached the maximum number of characters.");
			}else{
				$("#charleft").text(maxlength - currentLength + " chars left");
				
			}
		});

		// MANAGE ROLES AND ACCESS
		var usrRole = "{{$login_user->role ?? ''}}";

		$(".roledlink").hide();
		function protect() {
			$("." + usrRole).css("visibility", "visible");
			$("." + usrRole).show();
		}
		protect();

		$(window).on('load', function(){
			$('#cover').fadeOut(1000);
		});
		
        
	</script>	



