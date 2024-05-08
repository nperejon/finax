    class FinancialRegister {
        constructor(tabs) {
            this.tabs = tabs;
            this.actualTab = tabs[0];
            this.tabs.forEach(tab => {
                setupTab(tab);
            });
        }

        setupTab(tab) {
            tab.el.addEventListener('click', (e) => {
                this.actualTab.el.remove('active');
                this.actualTab.content.remove('none');
                tab.el.add('active');
                tab.content.add('none');

                this.actualTab = tab;
                this.register(tab);
            })
        }

        register(tab) {
            if (!tab.inputName || !tab.inputValue) return;

            const total = tab.totalDisplay;
            let totalValue = parseFloat(total.textContent.split('R$ ')[1]) + parseFloat(tab.inputValue);
            total.textContent = `Total: R$ ${totalValue.toFixed(2)}`;
    
            const registerBlocks = tab.querySelectorAll('.entry_name');
            let alreadyContains = false;

            registerBlocks.forEach(register => {
                if (register.textContent === tab.inputName) {
                    const oldValue = entry.nextElementSibling.textContent;
                    const newValue = parseFloat(oldValue.split(' ')[1]) + parseFloat(entryValue);
                    entry.nextElementSibling.textContent = `R$ ${newValue.toFixed(2)}`;
                    alreadyContains = true;
                    return;
                }
            });
    
            if (alreadyContains) return;
            
            const newEntryBlock = document.createElement('div');
            newEntryBlock.classList.add('entry');
            newEntryBlock.innerHTML = `
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="content">
                    <div class="content_text">
                        <span class="entry_name
                        ">${entryName}</span>
                        <span class="entry_value">R$ ${entryValue}</span>
                    </div>
                    <div class="content_buttons">
                        <button class="delete"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            `;
    
            tab.content.querySelector('.entries-grid').appendChild(entry);

            tab.el.querySelector('.delete').addEventListener('click', () => {
                const entryValue = parseFloat(entry.querySelector('.entry_value').textContent.split('R$ ')[1]);
                let totalValue = parseFloat(total.textContent.split('R$ ')[1]) - entryValue;
                total.textContent = `Total: R$ ${totalValue.toFixed(2)}`;
                entry.remove();
            });
            return;
        }

        updateTotal(value) {}

        setTabSwitcher(newTab) {

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
            inputName: document.querySelector('.register-entry input[type="text"]').value,
            inputValue: document.querySelector('.register-entry input[type="number"]').value,
            submitInput: document.querySelector('#register-entry-btn'),
            totalDisplay: document.querySelector('.entry-content .total'),
            type: "entry"
        },
        {
            el: exitsTab,
            content: exitContent,
            inputName: document.querySelector('.register-entry input[type="text"]').value,
            inputValue: document.querySelector('.register-entry input[type="number"]').value,
            submitInput: document.querySelector('#register-entry-btn'),
            totalDisplay: document.querySelector('.exit-content .total'),
            type: "exit"
        }
    ];

    new FinancialRegister(tabs);