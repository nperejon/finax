class FinancialRegister {
    constructor(tabs) {
        this.tabs = tabs;
        this.actualTab = tabs[0];
        this.tabs.forEach(tab => {
            this.setupTab(tab);
        });
    }

    setupTab(tab) {
        tab.el.addEventListener('click', (e) => {
            this.actualTab.el.classList.remove('active');
            this.actualTab.content.classList.add('none');
            tab.el.classList.add('active');
            tab.content.classList.remove('none');

            this.actualTab = tab;
        })

        tab.submitInput.addEventListener('click', () => {
            this.register(tab)
        });

        this.setupRemoveElements(tab);
    }

    setupRemoveElements(tab) {
        tab.content.querySelectorAll('.delete').forEach(deleteEl => {
            deleteEl.addEventListener('click', (e) => {
                const entry = e.target.closest('.entry');
                const entryValue = parseFloat(entry.querySelector('.entry_value').textContent.split('R$ ')[1]);
                let totalValue = parseFloat(tab.totalDisplay.textContent.split('R$ ')[1]) - entryValue;
                tab.totalDisplay.textContent = `Total: R$ ${totalValue.toFixed(2)}`;
                entry.remove();
            });
        });
    }
}

const entriesTab = document.querySelector('.entry');
const exitsTab = document.querySelector('.exit');
const entryContent = document.querySelector('.entry-content');
const exitContent = document.querySelector('.exit-content');

const tabs = [
    {
        el: entriesTab,
        content: entryContent,
        inputName: document.querySelector('.register-entry input[type="text"]'),
        inputValue: document.querySelector('.register-entry input[type="number"]'),
        submitInput: document.querySelector('#register-entry-btn'),
        totalDisplay: document.querySelector('.entry-content .total'),
        type: "entry"
    },
    {
        el: exitsTab,
        content: exitContent,
        inputName: document.querySelector('.register-entry input[type="text"]'),
        inputValue: document.querySelector('.register-entry input[type="number"]'),
        submitInput: document.querySelector('#register-entry-btn'),
        totalDisplay: document.querySelector('.exit-content .total'),
        type: "exit"
    }
];

new FinancialRegister(tabs);