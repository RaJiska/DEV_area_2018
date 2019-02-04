<<<<<<< dev
<<<<<<< HEAD
import React, {Component} from 'react';
import {StyleSheet, Text, View} from 'react-native';

export default class App extends Component {
  render() {
    return (
      <View style={styles.container}>
        <Text>Welcome to React Native!</Text>
=======
/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 * @flow
 */

=======
>>>>>>> feat(redux): add basic redux architecture"
import React, {Component} from 'react';
<<<<<<< HEAD
import {Button, StyleSheet, Text, View} from 'react-native';
import { fetchUser } from './actions/Actions';
import { connect } from 'react-redux';

export class App extends Component {
  componentWillMount() {
    //store.subscribe(() => this.setState(store.getState()));
  }

=======
import {StyleSheet, Text, View} from 'react-native';

export default class App extends Component {
>>>>>>> 5c602a7... feat(redux): add complete redux architecture
  render() {
    console.log("State:", this.props);
    
    return (
      <View style={styles.container}>
<<<<<<< dev
<<<<<<< dev
        <Text style={styles.welcome}>Welcome to React Native!</Text>
        <Text style={styles.instructions}>To get started, edit App.js</Text>
        <Text style={styles.instructions}>{instructions}</Text>
>>>>>>> 9f138f6b3b53e19da4456b928560bf55e05cb272
=======
=======
<<<<<<< HEAD
>>>>>>> feat(redux): add complete redux architecture
        <View style={{flex: 1, justifyContent: 'center', alignItems: 'center'}}>
          <Text style={{flex: 0.5, fontSize: 25, textAlign: 'center'}} >{this.props.user ? this.props.user.title : "No user fetched"}</Text>
        </View>
        <View style={{flex: 1, margin: 30}}>
          <Button onPress={() => this.props.dispatch(fetchUser())} title="Fetch user" color="#841584"/>
        </View>
<<<<<<< dev
>>>>>>> feat(redux): add basic redux architecture"
=======
=======
        <Text>Welcome to React Native!</Text>
>>>>>>> 5c602a7... feat(redux): add complete redux architecture
>>>>>>> feat(redux): add complete redux architecture
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
<<<<<<< dev
<<<<<<< dev
    alignItems: 'center',
    backgroundColor: '#F5FCFF',
<<<<<<< HEAD
  }
});
=======
  },
  welcome: {
    fontSize: 20,
    textAlign: 'center',
    margin: 10,
  },
  instructions: {
    textAlign: 'center',
    color: '#333333',
    marginBottom: 5,
  },
});
>>>>>>> 9f138f6b3b53e19da4456b928560bf55e05cb272
=======
=======
<<<<<<< HEAD
>>>>>>> feat(redux): add complete redux architecture
    backgroundColor: 'white',
  }
});

const mapStateToProps = (state, ownProps) => {
  console.log(state);
  
  return {
    isFetching: state.reducer.isFetching,
    user: state.reducer.user
  }
}

export default connect(mapStateToProps)(App)
<<<<<<< dev
>>>>>>> feat(redux): add basic redux architecture"
=======
=======
    alignItems: 'center',
    backgroundColor: '#F5FCFF',
  }
});
>>>>>>> 5c602a7... feat(redux): add complete redux architecture
>>>>>>> feat(redux): add complete redux architecture
