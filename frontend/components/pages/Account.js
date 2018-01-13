import React, {Component} from 'react';
import {hashHistory} from 'react-router';
import axios from 'axios';
import ChangePasswordForm from './forms/ChangePasswordForm';

export default class Account extends Component {

    constructor(props) {
        super(props);

        this.state = {
            isLoggedIn: null,
        };
    }

    componentDidMount() {
        axios.get(`/api/check-token?token=${localStorage.getItem('token')}`)
            .then(({data}) => {
                if (data.hasOwnProperty('success')) {
                    this.setState({
                        isLoggedIn: data.success,
                    })
                }
            });
    }

    render() {
        if (this.state.isLoggedIn === null) {
            return <p>Loading...</p>;
        }

        /** Redirect to login page*/
        if (this.state.isLoggedIn === false) {
            hashHistory.push('login');
            return null;
        }

        return (
            <div>
                <h1>Account page</h1>
                <ChangePasswordForm/>
            </div>
        );
    }
}