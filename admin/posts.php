<div class="container-fluid">
	<div class="card col-md-12">
		<div class="card-body">
			<div class="col-md-12">
				<button type="button" class="btn btn-primary btn-sm btn-block col-sm-2" id="new_post"><i class="fa fa-plus"></i> Новый пост</button>
			</div>
			<br>
			<div class="col-md-12">
				<table class="table table-bordered" id="post-tbl">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Заголовок</th>
							<th class="text-center">Категория</th>
							<th class="text-center">Статус</th>
							<th class="text-center">Действие</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
	<script>
		$('#new_post').click(function(){
				location.replace('index.php?page=manage_post')
		})
		window.load_tbl = function(){
			$('#post-tbl').dataTable().fnDestroy();
			$('#post-tbl tbody').html('<tr><td colspan="4" class="text-center">Пожалуйста подождите...</td></tr>')
			$.ajax({
				url:'ajax.php?action=load_post',
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						if(Object.keys(resp).length > 0){
							$('#post-tbl tbody').html('')
							var i = 1;
							Object.keys(resp).map(k=>{
								var tr = $('<tr></tr>')
								tr.append('<td class="text-center">'+(i++)+'</td>')
								tr.append('<td>'+resp[k].title+'</td>')
								tr.append('<td>'+resp[k].category+'</td>')
								tr.append('<td>'+(resp[k].status == 0 ? 'Для рассмотрения' : "Опубликован")+'</td>')
								tr.append('<td><center><button class="btn btn-info btn-sm edit_post" data-id = "'+resp[k].id+'"><i class="fa fa-edit"></i> Редактировать</button><button class="btn btn-info btn-sm preview_post" data-id = "'+resp[k].id+'"><i class="fa fa-eye"></i> Посмотреть</button><br><button class="btn btn-primary btn-sm publish_post" data-id = "'+resp[k].id+'"></i> Опубликовать</button><button class="btn btn-danger btn-sm remove_post" data-id = "'+resp[k].id+'"><i class="fa fa-trash"></i> Удалить</button></center></td>')
								$('#post-tbl tbody').append(tr)
							})
						}else{
						$('#post-tbl tbody').html('<tr><td colspan="4" class="text-center">Нет данных...</td></tr>')
						}
					}
				},
				complete:function(){
					$('#post-tbl').dataTable()
					manage_post();
				}
			})
		}
		function manage_post(){
			$('.edit_post').click(function(){
				location.replace('index.php?page=manage_post&id='+$(this).attr('data-id'))
			})
			$('.preview_post').click(function(){
				location.replace('index.php?page=preview_post&id='+$(this).attr('data-id'))
			})
			$('.remove_post').click(function(){
				// console.log('REMOVE')
				_conf("Вы уверены, что хотите удалить эти данные?",'remove_post',[$(this).attr('data-id')])
			})
			$('.publish_post').click(function(){
				// console.log('REMOVE')
				_conf("Вы уверены, что опубликуете эти данные?",'publish_post',[$(this).attr('data-id')])
			})
		}
		function remove_post($id){
			start_load()
			$.ajax({
				url:'ajax.php?action=remove_post',
				method:'POST',
				data:{id:$id},
				success:function(resp){
					if(resp == 1){
						alert_toast("Данные успешно удалены.",'success');
						$('.modal').modal('hide')
						load_tbl()
						end_load();
					}
				}
			})
		}
		function publish_post($id){
			start_load()
			$.ajax({
				url:'ajax.php?action=publish_post',
				method:'POST',
				data:{id:$id},
				success:function(resp){
					if(resp == 1){
						alert_toast("Данные успешно опубликованы.",'success');
						$('.modal').modal('hide')
						load_tbl()
						end_load();
					}
				}
			})
		}
		$(document).ready(function(){
			load_tbl()
		})
	</script>
</div>
<style type="text/css">
	td button{
		margin:10px !important;
	}
	td {
		vertical-align: middle !important;
	}
</style>