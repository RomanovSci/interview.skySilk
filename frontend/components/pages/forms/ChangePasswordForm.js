import React from 'react';
import BaseForm from './BaseForm';
import {NotificationContainer} from 'react-notifications';
import {rules} from '../validation/ChangePasswordRules';

export default class ChangePasswordForm extends BaseForm {
    constructor(props) {
        super(props);

        this.state = {
            oldPassword: '',
            newPassword: '',
            confirmPassword: '',
        }
    }

    handleInputChange(field, e) {
        this.setState({
            [field]: e.target.value,
        });
    }

    submit(e) {
        e.preventDefault();

        if (!this.validate(this.state, rules)) {
           return;
        }

        // TODO: Change password logic
    }

    render() {
        return (
            <form onSubmit={this.submit.bind(this)}>
                <div className="form-group">
                    <label htmlFor="old-password">Old password</label>
                    <input
                        type="password"
                        className="form-control"
                        id="old-password"
                        value={this.state.oldPassword}
                        onChange={this.handleInputChange.bind(this, 'oldPassword')}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="new-password">New password</label>
                    <input
                        type="password"
                        className="form-control"
                        id="new-password"
                        value={this.state.newPassword}
                        onChange={this.handleInputChange.bind(this, 'newPassword')}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="confirm-password">Confirm new password</label>
                    <input
                        type="password"
                        className="form-control"
                        id="confirm-password"
                        value={this.state.confirmPassword}
                        onChange={this.handleInputChange.bind(this, 'confirmPassword')}
                    />
                </div>
                <div className="form-group">
                    <input type="submit" className="btn btn-default" value="Change"/>
                </div>
                <NotificationContainer/>
            </form>
        );
    }
}