<<<<<<< HEAD
import {AppRegistry} from 'react-native';
import App from './App';
import React from 'react';
import {name as appName} from './app.json';
import configStore from './configStore'
import { Provider } from 'react-redux'

const store = configStore()

const RNRedux = () => (
    <Provider store={store}>
      <App />
    </Provider>
  )
  
AppRegistry.registerComponent(appName, () => RNRedux)
=======
/** @format */

import {AppRegistry} from 'react-native';
import App from './App';
import {name as appName} from './app.json';

AppRegistry.registerComponent(appName, () => App);
>>>>>>> 9f138f6b3b53e19da4456b928560bf55e05cb272
