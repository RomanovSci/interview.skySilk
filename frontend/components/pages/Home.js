import React, {Component} from 'react';
import axios from 'axios';
import {
    NotificationManager,
    NotificationContainer
} from 'react-notifications';

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

    render() {
        return (
            <div className="container">
                <h1>Home page</h1>
                <NotificationContainer/>
            </div>
        );
    }
}