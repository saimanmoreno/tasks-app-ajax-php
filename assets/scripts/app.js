$(document).ready(function () {

    listTasks();                                                                    // listar as tarefas

    $('#search-result').hide();                                                     // ocultar o card de resultados de pesquisa
    
    $('#search').keyup(searchTasks);                                                // pesquisar as tarefas ao escrever
    $('#search').on('click', () => { $('#search').val(''); searchTasks(); });       // limpar resultados da tarefa ao clicar no input
    $('#task-form').submit(createTask);                                             // adicionar nova tarefa


    // listar as tarefas
    function listTasks() {

        $.ajax({
            url: 'server/controller.php',
            type: 'GET',
            data: { action: 'listTasks' },
            success: function (response) {

                let tasks = JSON.parse(response);

                template = '';

                if (tasks.length > 0) {
                    tasks.forEach(task => {
                        template += `
                            <tr>
                                <td>${task.id}</td>
                                <td>${task.name}</td>
                                <td>${task.description}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-secondary btn-sm">
                                    <i class="fa-regular fa-circle-xmark"></i>
                                    </button>
                                </td>
                            </tr>
                        `});
                } else {
                    template += `
                            <tr>
                                <td colspan="4">
                                    <p class="my-3 d-flex justify-content-center">Sem tarefas criadas!</p>
                                </td>
                            </tr>
                            
                        `;
                }

                $('#tasks-table').html(template);

            }
        })
    }


    // criar uma tarefa
    function createTask() {

        e.preventDefault();

        const name = $('#name').val();

        // caso desativem o required
        if (!name) return;

        const postData = {
            name: $('#name').val(),
            description: $('#description').val(),
            action: 'createTask'
        }

        var submitButton = $('#submit-button');

        submitButton.text('Criando...');
        submitButton.prop("disabled", true);

        $.post('server/controller.php', postData, response => {
            console.log(response);

            $('#task-form').trigger('reset');
        })

        // 1 second delay
        setTimeout(function () {
            submitButton.text('Criar Tarefa');
            submitButton.prop("disabled", false);
            listTasks();
        }, 500);
    }


    // pesquisar as tarefas
    function searchTasks() {

        let searchText = $('#search').val();

        console.log(searchText);

        if (searchText) {
            $.ajax({
                url: 'server/controller.php',
                type: 'POST',
                data: { action: 'searchTasks', searchText },
                success: function (response) {

                    let tasksSearch = JSON.parse(response);
                    template = '';

                    if (tasksSearch.length > 0) {
                        tasksSearch.forEach(task => {
                            template += `
                            <li>
                                ${task.name}
                            </li>
                        `});
                    } else {
                        template += `
                            <div class="row">
                                <p class="my-3 d-flex justify-content-center">Sem resultados!</p>
                            </div>
                        `;
                    }

                    $('#container').html(template);
                    $('#search-result').show();

                }
            })
        } else {
            $('#search-result').hide();
        }
    }

})