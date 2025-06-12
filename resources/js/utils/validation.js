// Form validation utilities
export class FormValidator {
    constructor(form) {
        this.form = form;
        this.errors = {};
    }

    validate(rules) {
        this.errors = {};
        let isValid = true;

        for (const [field, fieldRules] of Object.entries(rules)) {
            const input = this.form.querySelector(`[name="${field}"]`);
            if (!input) continue;

            const value = input.value.trim();
            
            for (const rule of fieldRules) {
                if (!this.validateRule(value, rule, input)) {
                    isValid = false;
                    break;
                }
            }
        }

        this.displayErrors();
        return isValid;
    }

    validateRule(value, rule, input) {
        const [ruleName, ruleValue] = rule.split(':');

        switch (ruleName) {
            case 'required':
                if (!value) {
                    this.addError(input.name, 'Este campo es obligatorio');
                    return false;
                }
                break;

            case 'min':
                if (value.length < parseInt(ruleValue)) {
                    this.addError(input.name, `Mínimo ${ruleValue} caracteres`);
                    return false;
                }
                break;

            case 'max':
                if (value.length > parseInt(ruleValue)) {
                    this.addError(input.name, `Máximo ${ruleValue} caracteres`);
                    return false;
                }
                break;

            case 'email':
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    this.addError(input.name, 'Formato de email inválido');
                    return false;
                }
                break;

            case 'numeric':
                if (isNaN(value) || value === '') {
                    this.addError(input.name, 'Debe ser un número válido');
                    return false;
                }
                break;
        }

        return true;
    }

    addError(field, message) {
        if (!this.errors[field]) {
            this.errors[field] = [];
        }
        this.errors[field].push(message);
    }

    displayErrors() {
        // Clear previous errors
        this.form.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
        this.form.querySelectorAll('.invalid-feedback').forEach(el => {
            el.remove();
        });

        // Display new errors
        for (const [field, messages] of Object.entries(this.errors)) {
            const input = this.form.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('is-invalid');
                
                const feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                feedback.textContent = messages[0];
                input.parentNode.appendChild(feedback);
            }
        }
    }
}