$(function() {
    
    $('.btn.consult').click(() => {
        id = $('#productId').val();
        if (!/^[0-9]+$/.test(id)) { return alert('ID debe ser un numero'); }
        getProducts(id);
    });

    $('.btn.see-all').click(() => {
        getProducts();
    })


});

function findProduct(id) {
    $.get(`/products/${id}`, (data) => {
        showResults([data]);
    });
}

function getProducts(id) {
    emptyTable();
    setState('Cargando...');
    if (id) { return findProduct(id); }

    $.get('/products/all', (data) => {
        showResults(data);
    })
}

function setState(state) {
    if (!state) { return $('#result-state').toggle(false); }
    $('#result-state').text(state);
    $('#result-state').toggle(true);    
}

function emptyTable() {
    $('#result-body').html('');
}

function showResults(data) {
    data.forEach(product => {
        
        setState();

        if (product.error) { return setStatus(product.error); }
        
        if (product.status == -1) { return }

        $('<tr>').append(
            $('<td>').text(product.id),
            $('<td>').text(product.name),
            $('<td>').text(product.price),
        ).appendTo($('#result-body'));
    });
}