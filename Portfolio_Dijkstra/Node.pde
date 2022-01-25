class Node{
  int index; //頂点のインデックス
  EdgeSet inComing; //自身に入る辺の集合
  EdgeSet outGoing; //自身から出る辺の集合
  int dist; //ダイクストラ向け距離
  
  Node( int i ){
    index = i;
    inComing = new EdgeSet();
    outGoing = new EdgeSet();
    dist = Integer.MAX_VALUE; //無限の代わりに int の最大値を指定
  }
  
}

class NodeSet extends ArrayList<Node>{
  NodeSet(){
  }
  
  NodeSet( int n ){
    // n 個の頂点を生成し，自身に加える
    for( int i = 0; i < n; i++ ){
      add( new Node( i ) );
    }
  }
  
  //自身に含まれる Node のうち， dist が最小の Node を自身から remove し，その Node を返す
  Node removeMinDistNode(){ 
    Node minDistNode = get( 0 ); 
    for( Node u : this ){
      if( u.dist < minDistNode.dist ) minDistNode = u;
    }
    remove( minDistNode );
    return minDistNode;
  }
  
  //自身の深いコピーとなる NodeSet を生成し，返す
  NodeSet clone(){
    NodeSet ns = new NodeSet();
    for( Node v : this ){
      ns.add( v );
    }
    return ns;
  }
  
}
