$(function() {

    products = new ProductsAPI();
    table = new ProductTable();
    
    $('.btn.consult').click(() => {
        id = $('#productId').val();
        if (!/^[0-9]+$/.test(id)) { return alert('ID debe ser un numero'); }
        
        table.setState('Cargando...');
        products.all(id).then(data => table.render(data));
    });

    $('.btn.see-all').click(() => {
        table.setState('Cargando...');
        products.all().then(data => table.render(data));
    });

    $('.btn.truncate').click(() => {
        products.truncate().then(() => {
            table.emptyTable()
            table.setState('Se eliminaron todos los registros de la db');
        });
    });

    $('.btn.seed').click(() => {
        products.seed().then(() => { 
            table.setState('/products.json importado en la base de datos. Pulse "VER TODOS"');
        });
    })
    


    

});


class ProductTable {

    setState(state) {
        if (!state) { return $('#result-state').toggle(false); }
        $('#result-state').text(state);
        $('#result-state').toggle(true);    
    }
    
    emptyTable() {
        $('#result-body').html('');
    }
    

    render(data) {
        
        this.emptyTable();

        if (!data.length) { return this.setState('No hay registros en la base de datos.') }
        
        data.forEach(product => {
        
            this.setState();
    
            if (product.error) { return this.setState(product.error); }
            
            if (product.status == -1) { return }
    
            $('<tr>').prop('id', `p${product.id}`).addClass('result-row').append(
                $('<td>').text(product.id),
                $('<td>').text(product.name),
                $('<td>').text(product.price),
                $('<td>').append($('<i>').addClass('far fa-trash-alt')).click(() => {
                    products = new ProductsAPI();
                    products.disable(product.id).then(() => $(`#p${product.id}`).remove());
                })
            ).appendTo($('#result-body'));
        });
    }
}

class ProductsAPI {

    async find(id) {
        return await $.get(`/products/${id}`);
    }
    
    async all(id) {
        if (id) { return [await this.find(id)]; }
        return await $.get('/products/all');
    }
    
    async disable(id) {
        return await $.get(`/products/${id}/disable`);
    }

    async seed() {
        return await $.get(`/products/seed`);
    }

    async truncate() {
        return await $.get(`/products/truncate`);
    }
}