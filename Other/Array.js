const person = [{
        name: 'John',
        age: 30
    },
    {
        name: 'Jane',
        age: 15
    },
    {
        name: 'Tom',
        age: 29
    },
    {
        name: 'Alvin',
        age: 21
    },
    {
        name: 'Adam',
        age: 25
    }
]

// const filterName = person.map((person) => {
//     return person.name.concat(` has ${person.age}`);
// })

// const findPerson = person.find((person) => {
//     return person.age === 30;
// })

// const eachPerson = person.forEach(person => {
//     console.log(person.name, person.age);
// });

// const youngPerson = person.every((person) => {
//     return person.age <= 25
// })

// const averageAgePerson = person.reduce((avgAge, person) => {
//     return person.age + avgAge;
// }, 0)

// console.log(averageAgePerson / person.length);


const mapName = person.map((person) => {
    return person.name;
})

const includesPerson = mapName.includes('Ado');

console.log(includesPerson);