import React, {Component} from 'react';
import {StyleSheet, Text, View} from 'react-native';
import Login from './Login/Login'

export default class App extends Component {
  render() {
    return (
      <View style={styles.container}>
        <Login />
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