<<<<<<< dev
<<<<<<< dev
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
=======
=======
<<<<<<< HEAD
>>>>>>> feat(redux): add complete redux architecture
import React from 'react'
import { AppRegistry } from 'react-native'
>>>>>>> feat(redux): add basic redux architecture"

import { Provider } from 'react-redux'
import configureStore from './configureStore'
import App from './App'

<<<<<<< dev
AppRegistry.registerComponent(appName, () => App);
>>>>>>> 9f138f6b3b53e19da4456b928560bf55e05cb272
=======
const store = configureStore()

class RNRedux extends React.Component {
  render() {
    return (
      <Provider store={store}>
        <App />
      </Provider>
    );
  }
}

AppRegistry.registerComponent("DEV_area_2018", () => RNRedux);
<<<<<<< dev
>>>>>>> feat(redux): add basic redux architecture"
=======
=======
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
>>>>>>> 5c602a7... feat(redux): add complete redux architecture
>>>>>>> feat(redux): add complete redux architecture
