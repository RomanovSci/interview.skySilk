import React, {Component} from 'react';
import {NotificationManager} from 'react-notifications';
import validate from 'validate.js';

export default class BaseForm extends Component {

    constructor(props) {
        super(props);
    }

    validate(stateObject, rules) {
        let errors = validate(stateObject, rules);

        if (!errors) {
            return true;
        }

        /** Show first error */
        NotificationManager.error(errors[Object.keys(errors)[0]][0]);
        return false;
    }
}