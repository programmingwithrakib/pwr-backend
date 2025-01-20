You can think of a Mongoose schema as the configuration object for a Mongoose model. A SchemaType is then a configuration object for an individual property. A SchemaType says what type a given path should have, whether it has any getters/setters, and what values are valid for that path.

const schema = new Schema({ name: String });
schema.path('name') instanceof mongoose.SchemaType; // true
schema.path('name') instanceof mongoose.Schema.Types.String; // true
schema.path('name').instance; // 'String'

A SchemaType is different from a type. In other words, mongoose.ObjectId !== mongoose.Types.ObjectId. A SchemaType is just a configuration object for Mongoose. An instance of the mongoose.ObjectId SchemaType doesn't actually create MongoDB ObjectIds, it is just a configuration for a path in a schema.

The following are all the valid SchemaTypes in Mongoose. Mongoose plugins can also add custom SchemaTypes like int32. Check out Mongoose's plugins search to find plugins.

    String
    Number
    Date
    Buffer
    Boolean
    Mixed
    ObjectId
    Array
    Decimal128
    Map
    Schema
    UUID
    BigInt
    Double
    Int32

Example

const schema = new Schema({
name: String,
binary: Buffer,
living: Boolean,
updated: { type: Date, default: Date.now },
age: { type: Number, min: 18, max: 65 },
mixed: Schema.Types.Mixed,
_someId: Schema.Types.ObjectId,
decimal: Schema.Types.Decimal128,
double: Schema.Types.Double,
int32bit: Schema.Types.Int32,
array: [],
ofString: [String],
ofNumber: [Number],
ofDates: [Date],
ofBuffer: [Buffer],
ofBoolean: [Boolean],
ofMixed: [Schema.Types.Mixed],
ofObjectId: [Schema.Types.ObjectId],
ofArrays: [[]],
ofArrayOfNumbers: [[Number]],
nested: {
stuff: { type: String, lowercase: true, trim: true }
},
map: Map,
mapOfString: {
type: Map,
of: String
}
});

// example use

const Thing = mongoose.model('Thing', schema);

const m = new Thing;
m.name = 'Statue of Liberty';
m.age = 125;
m.updated = new Date;
m.binary = Buffer.alloc(0);
m.living = false;
m.mixed = { any: { thing: 'i want' } };
m.markModified('mixed');
m._someId = new mongoose.Types.ObjectId;
m.array.push(1);
m.ofString.push('strings!');
m.ofNumber.unshift(1, 2, 3, 4);
m.ofDates.addToSet(new Date);
m.ofBuffer.pop();
m.ofMixed = [1, [], 'three', { four: 5 }];
m.nested.stuff = 'good';
m.map = new Map([['key', 'value']]);
m.save(callback);

The type Key

type is a special property in Mongoose schemas. When Mongoose finds a nested property named type in your schema, Mongoose assumes that it needs to define a SchemaType with the given type.

// 3 string SchemaTypes: 'name', 'nested.firstName', 'nested.lastName'
const schema = new Schema({
name: { type: String },
nested: {
firstName: { type: String },
lastName: { type: String }
}
});

As a consequence, you need a little extra work to define a property named type in your schema. For example, suppose you're building a stock portfolio app, and you want to store the asset's type (stock, bond, ETF, etc.). Naively, you might define your schema as shown below:

const holdingSchema = new Schema({
// You might expect `asset` to be an object that has 2 properties,
// but unfortunately `type` is special in Mongoose so mongoose
// interprets this schema to mean that `asset` is a string
asset: {
type: String,
ticker: String
}
});

However, when Mongoose sees type: String, it assumes that you mean asset should be a string, not an object with a property type. The correct way to define an object with a property type is shown below.
