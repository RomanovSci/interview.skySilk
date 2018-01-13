import React from 'react';
import BaseForm from './BaseForm';
import {rules} from '../validation/RegisterRules';
import {NotificationContainer} from 'react-notifications';
import axios from 'axios';

export default class LoginForm extends BaseForm {
    constructor(props) {
        super(props);

        this.state = {
            username: '',
            password: '',
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

        axios.post('/api/register', this.state)
            .then(({data}) => {

                if (data.hasOwnProperty('success') && data.success) {

                    // TODO: Handling
                    // localStorage.setItem('token', data.token);
                    // hashHistory.push('/');
                    // return;
                }

                NotificationManager.error(data.message);
            })
    }

    render() {
        return (
            <form onSubmit={this.submit.bind(this)}>
                <div className="form-group">
                    <label htmlFor="username">Email</label>
                    <input
                        type="text"
                        className="form-control"
                        id="username"
                        value={this.state.username}
                        onChange={this.handleInputChange.bind(this, 'username')}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="password">Password</label>
                    <input
                        type="password"
                        className="form-control"
                        id="password"
                        value={this.state.password}
                        onChange={this.handleInputChange.bind(this, 'password')}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="confirm-password">Password confirmation</label>
                    <input
                        type="password"
                        className="form-control"
                        id="confirm-password"
                        value={this.state.confirmPassword}
                        onChange={this.handleInputChange.bind(this, 'confirmPassword')}
                    />
                </div>
                <div className="form-group">
                    <input type="submit" className="btn btn-default" value="Register"/>
                </div>
                <NotificationContainer/>
            </form>
        );
    }
}