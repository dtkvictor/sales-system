export default class HTMLTableHandler {
    table;

    /**
     * @param { HTMLTableElement } table 
     */
    constructor(table) {
        this.table = table;
        for(let section of this.table.children) {
            this.table[section.localName] = section;
        }
    }

    resetSection(section) 
    {
        if(this.table[section]) {
            this.table[section].innerHTML = '';
        }
    }

    appendRowToHead(row)
    {
        this.table.thead.appendChild(row)
    }

    appendRowToBody(row)
    {
        this.table.tbody.appendChild(row)
    }

    appendRowToFoot(row)
    {
        this.table.tfoot.appendChild(row)
    }

    /**
     * Create a table
     * @param { HTMLTableSectionElement } thead
     * @param { HTMLTableSectionElement } tbody
     * @param { HTMLTableSectionElement } tfooter
     * @returns { HTMLTableElement }
     */
    createHead(thead, tbody, tfooter=null) 
    {
        const table = document.createElement('table');
        table.appendChild(thead);
        table.appendChild(tbody);
        if(tfooter) {
            table.appendChild(tfooter);
        }
        return table;
    }

    /**
     * Create a table head
     * @param { Array<HTMLTableCellElement> } cells
     * @returns { HTMLTableSectionElement }
     */
    createHead(cells) 
    {
        const head = document.createElement('thead');
        cells.forEach(cell => body.appendChild(cell));
        return head;
    }

    /**
     * Create a table body
     * @param { Array<HTMLTableRowElement> } rows
     * @returns { HTMLTableSectionElement }
     */
    createBody(rows) 
    {
        const body = document.createElement('tbody');
        rows.forEach(row => body.appendChild(row));
        return body;
    }

    /**
     * Create a table row
     * @param { Array<HTMLTableCellElement> } cells
     * @returns { HTMLTableRowElement }
     */
    createRow(cells = []) 
    {
        const row = document.createElement('tr');
        cells.forEach(cell => row.appendChild(cell));
        return row;
    }

    /**
     * Create a table cell.
     * @param { Element|string } content 
     * @param { string } type accept: th|td 
     * @returns { HTMLTableCellElement }
     */
    createCell(content='', type='td')
    {
        const cell = document.createElement(type);
              cell.style.verticalAlign = 'middle';
              
        if (content instanceof Element) {
            cell.appendChild(content);
        }else{
            cell.textContent = content;
        }
        return cell;
    }
}