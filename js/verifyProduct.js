$(function(){
    $('#name').on('input', function(){
        if(this.value)
            $('#nameError').text('');
    });

    $('#type').on('input', function(){
        if(this.value)
            $('#typeError').text('');
    });

    $('#description').on('input', function(){
        if(this.value)
            $('#descriptionError').text('');
    });

    $('#stock').on('input', function(){
        if(this.value.match(/^[0-9]*$/))
            $('#stockError').text('');
    });

    $('#price').on('input', function(){
        if(this.value.match(/^[0-9]*([\.][0-9][0-9])?$/))
            $('#priceError').text('');
    });
});