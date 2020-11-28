jQuery(function ($) {

    $("body").on("click", ".j-fuerza", function (event) {
        event.preventDefault();
        const button = $(this);
        const action = button.data("action");
        const form = button.closest("form").serialize() + "&action=" + action;

        $.ajax({
            url: wp.fuerzaUrl,
            type: "POST",
            data: form,
            beforeSend: () => {
                $('body').find('input').removeClass('d-error')
                $('.j-text-errors').remove();
                button.find('.j-fuerza-title').addClass('d-none')
                button.find('#j-fuerza-land').removeClass('d-none')
            },
        }).then((resposta) => {
            button.find('#j-fuerza-land').addClass('d-none')
            button.find('.j-fuerza-title').removeClass('d-none')

            if (resposta) {

                sendMessage(resposta)

            } else {

                alert('several errors, please try again')

            }
        });

    });

    function sendMessage(resposta) {

        const { field, message } = resposta.data

        const item = $(`input[name='${field}']`)

        if (resposta.success) {

            $('body').find('input').val('');

            $('.box-form-fuerza-button').after(` 
              <small class="text-muted j-text-errors pt-4">Sua intenção em participar do curso
              foi enviada, aguarde um momento que vamos te redirecionar para sua inscrição</small>
              `);

            setTimeout(function () {

                setNewClient(resposta.data)

            }, 5000)

        } else {
            item.addClass('d-error');

            item.val(message)
        }

    }

    function setNewClient(data) {

        const storage = {
            id: data.id,
            name: data.name,
            email: data.email,
            course: data.course,
            courser_id: data.courser_id,
        }

        localStorage.setItem('fuerza-cursos:client', JSON.stringify(storage));

        window.location.href = `${data.link}`

    }

    const inputs = [...document.querySelectorAll('input')];

    inputs.forEach(input =>{
        input.addEventListener('focusin', ()=>{
            input.value = '';
        })
    })

});


