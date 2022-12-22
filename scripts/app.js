$(document).ready(function () {

    $('#search-result').hide();

    // Todo: esconder o card de resultados da pesquisa quando não for encontrado valores correspondentes ou mostrar mensagem de sem sucesso
    $('#search').keyup(searchTasks);
    $('#search').on('click', () => {

        $('#search').val('');

        searchTasks();

    });

    function searchTasks(e) {

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

    
    $('#task-form').submit(function (e) {

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
        }, 1000);
    })

})