	$(document).ready(function () {
		
		function UpdateProject(id_project,name,mode) {
			$.ajax({
				type: 'POST',
				url: '',
				async: true,
				cache: false,
				data: 'controller=project&action=updateName&ajax=true&id_project='+id_project+'&name='+name+'&mode='+mode,
				
				success: function(jsonData,textStatus,jqXHR)
				{
					result = JSON.parse(jsonData);

					if (result['errors'].length > 0) {
						notice(result['errors']);
					} else {
						if (mode == 'create') {
							$('[data-id-project="'+id_project+'"]').data("mode-project", 'update');
							$('[data-id-project="'+id_project+'"]').data("id-project", result['data']['project_id']);

							$('[data-id-project="'+id_project+'"]').attr("data-mode-project", 'update');
							$('[data-id-project="'+id_project+'"]').attr("data-id-project", result['data']['project_id']);
						}
						notice(result['data']['status']);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown)
				{
					notice(XMLHttpRequest);
					notice(textStatus);
					notice(errorThrown);
				}
			});
		};

		function DeleteProject(id_project) {
			$.ajax({
				type: 'POST',
				url: '',
				async: true,
				cache: false,
				data: 'controller=project&action=delete&ajax=true&id_project='+id_project,
				
				success: function(jsonData,textStatus,jqXHR)
				{
					result = JSON.parse(jsonData);

					if (result['errors'].length > 0) {
						notice(result['errors']);
					} else {
						$('[data-id-project="'+id_project+'"]').remove();
						notice(result['data']['status']);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown)
				{
					notice(XMLHttpRequest);
					notice(textStatus);
					notice(errorThrown);
				}
			});
		};

		function createTask(id_project) {
			var project = $('[data-id-project="'+id_project+'"]');
			task_name  = project.find('.new-task').val();

			$.ajax({
				type: 'POST',
				url: '',
				async: true,
				cache: false,
				data: 'controller=project&action=createTask&ajax=true&id_project='+id_project+'&task_name='+task_name,
				
				success: function(jsonData,textStatus,jqXHR)
				{
					console.log(jsonData);
					result = JSON.parse(jsonData);

					if (result['errors'].length > 0) {
						notice(result['errors']);
					} else {
						notice(result['data']['status']);
						addTask(id_project ,result['data']['task_id'],task_name);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown)
				{
					notice(XMLHttpRequest);
					notice(textStatus);
					notice(errorThrown);
				}
			});
		};

		function updateTaskName(task_id,name) {
			$.ajax({
				type: 'POST',
				url: '',
				async: true,
				cache: false,
				data: 'controller=project&action=updateTaskName&ajax=true&task_id='+task_id+'&name='+name,
				
				success: function(jsonData,textStatus,jqXHR)
				{
					result = JSON.parse(jsonData);

					if (result['errors'].length > 0) {
						notice(result['errors']);
					} else {
						notice(result['data']['status']);
						id_project = $('[data-id-task="'+task_id+'"]').data('id-task');
						addTask(id_project ,result['data']['task_id'],task_name);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown)
				{
					notice(XMLHttpRequest);
					notice(textStatus);
					notice(errorThrown);
				}
			});
		};

		function deleteTask(task_id) {
			console.log(task_id);
			$.ajax({
				type: 'POST',
				url: '',
				async: true,
				cache: false,
				data: 'controller=project&action=deleteTask&ajax=true&task_id='+task_id,
				
				success: function(jsonData,textStatus,jqXHR)
				{
					result = JSON.parse(jsonData);
					
					if (result['errors'].length > 0) {
						notice(result['errors']);
					} else {
						notice(result['data']['status']);
						$('[data-id-task="'+task_id+'"]').remove();
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown)
				{
					notice(XMLHttpRequest);
					notice(textStatus);
					notice(errorThrown);
				}
			});
		};

		function addProject(project_id) {
			var new_project = $('\
				<div class="project" data-id-project="'+project_id+'" data-mode-project="create">\
					<div class="project-header">\
						<div class="project-name">\
							<div class="project-actions-block hidden">\
							</div>\
						</div>\
					</div>\
					<div class="new-task-bar">\
						<div class="form-inline">\
							<input name="new-task" type="text" class="form-control new-task"  placeholder="Start typing here to create task">\
						</div>\
					</div>\
					<ul class="list-group sortable">\
					</ul>\
				</div>');

			new_project.find('.sortable').sortable();

			var project_edit_btn = $('<span class="project-action project-edit"></span>');
			
				project_edit_btn.click(function() {
					$(this).parents('.project-name').find('.project-name-ed').removeAttr('disabled');
					$(this).parents('.project-name').find('.project-name-ed').focus();
				});

			var project_delete_btn = $('<span class="project-action project-delete"></span>');
			
				project_delete_btn.click(function() {
					if (confirm('Delete project?')) {
						var id_project = $(this).parents('.project').data('id-project');
						DeleteProject(id_project);
					}
				});

			var project_name_ed = $('<input class="project-name-ed inline-edit" type="text" value="" pattern="[a-z0-9. -]+" placeholder="Enter the name of the project" disabled>');

				project_name_ed.blur(function() {
					if ($(this).val().length>0) {
						$(this).attr('disabled', true);
						var update_mode = $(this).parents('.project').data('mode-project');
						var id_project = $(this).parents('.project').data('id-project');
						UpdateProject(id_project, $(this).val(), update_mode);
					} else {
						notice('Enter Project name');
						$(this).focus();
					}



				});

			var project_add_task_btn = $('<button type="button" class="btn btn-success add-task-btn">Add Task</button>');

				project_add_task_btn.click(function() {
					createTask($(this).parents('.project').data('id-project'));
				});

			new_project.find('.project-actions-block').append(project_delete_btn);
			new_project.find('.project-actions-block').append(project_edit_btn);
			new_project.find('.project-actions-block').before(project_name_ed);
			new_project.find('.new-task').after(project_add_task_btn);




			new_project.hover(function() {
				$(this).find('.project-actions-block').removeClass('hidden');
			}, function() {
				$(this).find('.project-actions-block').addClass('hidden');
			});

			$(new_project).insertBefore('#add-project-btn');

			$('[data-id-project="'+project_id+'"]').find('.project-name-ed').removeAttr('disabled');;
			$('[data-id-project="'+project_id+'"]').find('.project-name-ed').focus();
		};

		function addTask(project_id,task_id,task_name) {
			var project = $('[data-id-project="'+project_id+'"]');

						project.find('.new-task').val("");

						var new_task = $('\
							<li class="list-group-item task-block" data-id-task="'+task_id+'">\
										<div class="status-block">\
											<input type="checkbox" value="">\
										</div>\
										<div class="separator"></div>\
										<div class="actions-block hidden">\
											<span class="task-action task-sort"></span>\
										</div>\
									</li>');

						var task_name = $('<input class="task-name inline-edit" type="text" value="'+ task_name +'"  disabled>');

							task_name.blur(function(event) {
								task_name_text = $(this).parents('.task-block').find('.task-name').val();
								task_id = $(this).parents('.task-block').data('id-task');
								updateTaskName(task_id,task_name_text);
								$(this).attr('disabled', true);
							});

						var task_edit = $('<span class="task-action task-edit"></span>');

							task_edit.click(function() {
								$(this).parents('.task-block').find('.task-name').removeAttr('disabled');
								$(this).parents('.task-block').find('.task-name').focus();;
							});


						var task_delete = $('<span class="task-action task-delete"></span>');
							task_delete.click(function() {
								if (confirm("Delete Task? ")) {
									task_id = $(this).parents('.task-block').data('id-task');
									deleteTask(task_id);
								}
							});

						new_task.find('.separator').after(task_name);
						new_task.find('.task-sort').before(task_delete);
						new_task.find('.task-sort').before(task_edit);


						new_task.hover(function() {
							$(this).find('.actions-block').removeClass('hidden');
							$(this).find('input').css('background-color', '#fcfed5');
						}, function() {
							$(this).find('.actions-block').addClass('hidden');
							$(this).find('input').css('background-color', '#fff');
						});

						project.find('.list-group').append(new_task);
		};

		function notice(message) {
			var noticeDiv = $('<div class="notice"><p class="notice-message">'+message+'</p></div>');
			$('.notice-block').append(noticeDiv.fadeIn(500).delay(3000).fadeOut(500));
		};

		function showProjects(projects) {
			$('.auth-block').remove();
			$('.container').append('\
				<form class="col-md-4 col-md-offset-4">\
					<div class="form-actions">\
				  <button class="btn btn-large btn-primary" type="submit" id="logout">Logout</button>\
			  </div>\
		  </form>\
			<div class="col-md-6 col-md-offset-3" id="projects-list">\
				<button type="button" class="btn btn-primary btn-lg" id="add-project-btn">Add TODO List</button>\
			</div>')



			for (var index in projects) {
				addProject(projects[index]['id']);

				if (typeof(projects[index]['tasks']) != 'undefined') {
					for (task in projects[index]['tasks']) {
						addTask(projects[index]['id'],projects[index]['tasks'][task].id,projects[index]['tasks'][task].name)
					}
				}
			}
		};

		$('#add-project-btn').click(function() {
			var temp_id = 'temp_' + parseInt(Math.random()* new Date().getTime()); 
			addProject(temp_id);
		});

		$('#sign-up').click(function() {
			$('.form-group h2').text('Please register');
			$('#password2').parent('div').removeClass('hidden');
			$('.bg-info').remove();
			
			$('#login').addClass('hidden');
			$('#register').removeClass('hidden');
		});

		$('.form-control').change(function(event) {
			$('.bg-danger').remove();
		});

		$('#register').click(function() {
			console.log('click Register');
			Register();
		});		

		$('#login').click(function() {
			console.log('click Login');
			login();
		});		

		$('#logout').click(function() {
			console.log('click logout');
			logout();
		});

		function showAuthErrors(errors) {
			errors.forEach(function(item, i, errors) {
				$('.helpers').append('<p class="helper bg-danger">'+ item +'</p>');
			});
		};

		function logout() {
			$.ajax({
				type: 'POST',
				url: '',
				async: true,
				cache: false,
				data: 'controller=user&action=logout&ajax=true&username=',
				
				success: function(jsonData,textStatus,jqXHR)
				{
					console.log('success');
					console.log(jsonData);
					console.log(textStatus);
					console.log(jqXHR);
					window.location.reload();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown)
				{
					console.log('error');
					console.log(XMLHttpRequest);
					console.log(textStatus);
					console.log(errorThrown);
				}
			});
		};

		function login() {
			console.log('in Login');
			var username = $("input[name='username']").val();
			var password = $("input[name='password1']").val();

			$.ajax({
				type: 'POST',
				url: '',
				async: true,
				cache: false,
				data: 'controller=user&action=login&ajax=true&username='+username+'&password='+password,
				
				success: function(jsonData,textStatus,jqXHR)
				{
					result = JSON.parse(jsonData);
					if (result['errors'].length > 0) {
						showAuthErrors(result['errors']);
					} else {
						showProjects(result['data']['projects']);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown)
				{
					console.log('error');
					console.log(XMLHttpRequest);
					console.log(textStatus);
					console.log(errorThrown);
				}
			});
		};

		function Register() {
			var username = $("input[name='username']").val();
			var password1 = $("input[name='password1']").val();
			var password2 = $("input[name='password2']").val();

			$.ajax({
				type: 'POST',
				url: '',
				async: true,
				cache: false,
				data: 'controller=user&action=create&ajax=true&username='+username+'&password1='+password1+'&password2='+password2,
				
				success: function(jsonData,textStatus,jqXHR)
				{
					result = JSON.parse(jsonData);

					if (result['errors'].length > 0) {
						showAuthErrors(result['errors']);
					} else {
						notice(result['data']['status']);
						window.location.reload();
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown)
				{
					console.log('error');
					console.log(XMLHttpRequest);
					console.log(textStatus);
					console.log(errorThrown);
				}
			});
		};
	});