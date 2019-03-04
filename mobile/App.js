import React, {Component} from 'react';
import {StyleSheet, View} from 'react-native';
import Login from './Login/Login'
import {connect} from 'react-redux'
import {setUser, twitterSignIn, setPage, googleSignIn} from './actions/Actions'
import LoginServices from './Login/LoginServices';

class App extends Component {

  _getPage() {
    switch (this.props.actualPage) {
      case 'LOGIN':
        return (<Login {...this.props}/>)
      case 'LOGIN_SERVICES':
        return (<LoginServices {...this.props}/>)
      default:
        return (<Login {...this.props}/>)
    }
  }

  render() {
    return (
      <View style={styles.container}>
        {this._getPage()}
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
    },
    setPage: (page) => {
      dispatch(setPage(page))
    },
    twitterSignIn: (authToken, authTokenSecret) => {
      dispatch(twitterSignIn(authToken, authTokenSecret))
    },
    googleSignIn: (googleToken) => {
      dispatch(googleSignIn(googleToken))
    }
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(App);