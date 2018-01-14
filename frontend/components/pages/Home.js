import React, {Component} from 'react';
import axios from 'axios';
import {hashHistory} from 'react-router';

export default class Home extends Component {

    constructor(props) {
        super(props);

        this.state = {
            isLoggedIn: false,
        }
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

    handleLogout(e) {
        e.preventDefault();

        localStorage.removeItem('token');
        hashHistory.push('login');
    }

    renderMenuList() {
        if (this.state.isLoggedIn) {
            return (
                <ul>
                    <li>
                        <a href="#/account">Account</a>
                    </li>
                    <li>
                        <a href="#" onClick={this.handleLogout.bind(this)}>Logout</a>
                    </li>
                </ul>
            );
        }

        return (
            <ul>
                <li>
                    <a href="#/register">Register</a>
                </li>
                <li>
                    <a href="#/login">Login</a>
                </li>
            </ul>
        );
    }

    render() {
        return (
            <div className="container">
                {this.renderMenuList()}
            </div>
        );
    }
}