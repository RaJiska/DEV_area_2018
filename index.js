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
