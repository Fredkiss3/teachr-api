import React, {useState} from 'react';
import { StyleSheet, Text, View } from 'react-native';

export default function App() {
  const [todos, setTodos] = useState([
    { task: 'Do Something', completed: false },
    { task: 'Do Something', completed: true },
    { task: 'Do Something', completed: false },
    { task: 'Do Something', completed: true },
    { task: 'Do Something', completed: false },
  ]);

  const count = 10;

  return (
      <View style={styles.container}>
        {todos.map((todo, i) => {
          return (
              <Text key={i}>
                {todo.task} {todo.completed ? '🥅' : '🎯'}
              </Text>
          );
        })}
      </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
