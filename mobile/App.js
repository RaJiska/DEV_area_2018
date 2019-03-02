import React, {Component} from 'react';
import {StyleSheet, View} from 'react-native';
import Login from './Login/Login'
import {connect} from 'react-redux'
import {setUser} from './actions/Actions'

class App extends Component {
  render() {
    console.log(this.props);
    return (
      <View style={styles.container}>
        <Login {...this.props}/>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: 'rgba(0, 0, 0, 0.85)',
  }
});

const mapStateToProps = state => {
  return state
}

const mapDispatchToProps = dispatch => {
  return {
    setUser: (token) => {
      dispatch(setUser(token))
    }
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(App);