import HTMLTableHandler from '../../../helpers/HTMLTableHandler.js';

export default (shoppingCart, callback) => {

    const table = document.getElementById("shoppingCartTable");
    const btnClearCart = document.getElementById("clearCart");
    const tableHandler = new HTMLTableHandler(table);

    const addTotalValueToFoot = () => {
        const cellWhiteSpace = tableHandler.createCell(""); 
            cellWhiteSpace.colSpan = 4;

        const cellLabel = tableHandler.createCell("Total value", 'th');
        const cellTotalValue = tableHandler.createCell('$' + shoppingCart.getTotalValue());

        const row = tableHandler.createRow([
            cellWhiteSpace,
            cellLabel,
            cellTotalValue,
        ]);

        tableHandler.appendRowToFoot(row);
    }

    (shoppingCart.get()).forEach(item => {
        const img = document.createElement('img');
            img.src = item.thumb;
            img.width = '48';
            img.height = '48';
            img.addEventListener('error', event => {
                    event.target.src = "/assets/image/default.png";
            })

        const row = tableHandler.createRow([
                        tableHandler.createCell(item.id),
                        tableHandler.createCell(img),
                        tableHandler.createCell(item.name),
                        tableHandler.createCell(item.price),
                        tableHandler.createCell(item.amount),
                        tableHandler.createCell(`$` + (item.amount * item.price)),
                    ]);

        tableHandler.appendRowToBody(row);
    });

    btnClearCart.addEventListener('click', () => {
        shoppingCart.clear();
        tableHandler.resetSection('tbody');
        tableHandler.resetSection('tfoot');
        addTotalValueToFoot();
        callback();
    });

    addTotalValueToFoot();
}